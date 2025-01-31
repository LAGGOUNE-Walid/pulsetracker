<?php

namespace Tests\Feature;

use App\Enums\GeofenceCacheKeysEnum;
use App\Jobs\ProcessGeofence;
use App\Models\App;
use App\Models\Device;
use App\Models\DeviceType;
use App\Models\Geofence;
use App\Models\User;
use App\Models\WebhookSignature;
use App\Services\AppGeofencesCacheService;
use App\Services\DeviceGeofenceStateService;
use App\Services\GeofencingService;
use App\Services\WebhookService;
use GeoJson\Geometry\LinearRing;
use GeoJson\Geometry\Point;
use GeoJson\Geometry\Polygon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Spatie\WebhookServer\CallWebhookJob;
use Tests\TestCase;

class UserGeofencesTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_geofence(): void
    {
        Cache::spy();
        Queue::fake();
        Redis::shouldReceive('sadd')
            ->once()
            ->andReturn(true);

        Redis::shouldReceive('set')
            ->once()
            ->andReturn(true);
        $user = User::factory()->has(App::factory()->count(1))->create()->first();
        $response = $this->actingAs($user)->post('/api/geofences', [
            'app_id' => $user->apps()->first()->id,
            'name' => 'My test',
            'webhook_url' => 'https://www.google.com',
            'geometry' => json_encode(['geometry' => (new Polygon([
                new LinearRing([
                    new Point([1, 1]),
                    new Point([2, 2]),
                    new Point([3, 3]),
                    new Point([1, 1]),
                ]),
            ]))->jsonSerialize()]),
        ]);

        $response->assertJson(
            function (AssertableJson $json) {
                return $json->has('data');
            }
        );
    }

    public function test_creating_geo_fences_validation(): void
    {
        Cache::spy();
        Queue::fake();
        $user = User::factory()->has(App::factory()->count(1))->create()->first();
        $response = $this->actingAs($user)->post('/api/geofences', [
            'app_id' => $user->apps()->first()->id,
            'name' => 'My test',
            'webhook_url' => 'https://www.google.com',
            'geometry' => json_encode([]),
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_getting_user_geofences(): void
    {
        Queue::fake();
        Cache::spy();
        $user = User::factory()->has(
            App::factory()->count(1)->has(
                Geofence::factory()->count(10)
            )
        )->create()->first();

        $response = $this->actingAs($user)->getJson('/api/geofences');
        $response->assertJson(
            function (AssertableJson $json) {
                return $json->has('meta')
                    ->has('links')
                    ->has('data', 10);
            }
        );
    }

    public function test_getting_single_geofence(): void
    {
        Queue::fake();
        Cache::spy();
        $user = User::factory()->has(
            App::factory()->count(1)->has(
                Geofence::factory()->count(10)
            )
        )->create()->first();

        $response = $this->actingAs($user)->getJson('/api/geofences/'.$user->geofences()->first()->id);
        $response->assertJson(
            function (AssertableJson $json) {
                return $json->has('data');
            }
        );
    }

    public function test_updating_geofence(): void
    {
        Queue::fake();
        Cache::spy();

        $user = User::factory()->has(
            App::factory()->count(5)->has(
                Geofence::factory()->count(10)
            )
        )->create()->first();

        $geofence = $user->geofences()->first();
        $oldAppId = $geofence->app_id;

        $response = $this->actingAs($user)->putJson('/api/geofences/'.$geofence->id, [
            'name' => 'foo',
            'app_id' => $geofence->app_id,
        ]);
        $response->assertStatus(Response::HTTP_OK);

        $this->assertNotEquals('foo', $geofence->name);

        $response = $this->actingAs($user)->putJson('/api/geofences/'.$geofence->id, [
            'name' => 'foo',
            'app_id' => $geofence->app_id,
            'geometry' => json_encode([]),
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $newAppId = $user->apps()->where('id', '!=', $geofence->app_id)->first()->id;
        Redis::shouldReceive('srem')
            ->once()
            ->andReturn(true);

        Redis::shouldReceive('sadd')
            ->once()
            ->andReturn(true);

        Redis::shouldReceive('set')
            ->once()
            ->andReturn(true);
        $response = $this->actingAs($user)->putJson('/api/geofences/'.$geofence->id, [
            'name' => 'foo',
            'app_id' => $newAppId,
        ]);

        $response->assertStatus(Response::HTTP_OK);

        $this->assertNotEquals($newAppId, $oldAppId);
    }

    public function test_point_entering_user_geofences_test(): void
    {
        Cache::spy();
        Queue::fake();
        Redis::shouldReceive('sadd')
            ->once()
            ->andReturn(true);

        Redis::shouldReceive('set')
            ->once()
            ->andReturn(true);
        DeviceType::factory()->count(1)->create();
        $user = User::factory()
            ->has(
                App::factory()->has(
                    Device::factory()->count(1)
                )->count(1)
            )
            ->has(WebhookSignature::factory()->count(1))->create()
            ->first();
        $response = $this->actingAs($user)->post('/api/geofences', [
            'app_id' => $user->apps()->first()->id,
            'name' => 'My test',
            'webhook_url' => 'https://related-snapper-allowed.ngrok-free.app',
            'geometry' => json_encode(['geometry' => (new Polygon([
                new LinearRing([
                    new Point([1, 1]),
                    new Point([1, 2]),
                    new Point([2, 2]),
                    new Point([2, 1]),
                    new Point([1, 1]),
                ]),
            ]))->jsonSerialize()]),
        ]);

        $response->assertJson(
            function (AssertableJson $json) {
                return $json->has('data');
            }
        );

        $this->assertCount(1, App::all());
        $this->assertCount(1, Device::all());
        $this->assertCount(1, Geofence::all());

        $appGeofencesCacheService = new AppGeofencesCacheService;
        $geofencingService = new GeofencingService($appGeofencesCacheService);
        $deviceGeofenceStateService = new DeviceGeofenceStateService;
        $processGeofence = new ProcessGeofence(
            $user->apps()->first(),
            $user->apps()->first()->devices()->first(),
            new Point([1, 1]),
            time(),
            $geofencingService,
            $deviceGeofenceStateService,
            new WebhookService
        );
        Redis::shouldReceive('SMEMBERS')
            ->with($appGeofencesCacheService->getAppFencesCacheKeyByApp($user->apps()->first()))
            ->andReturn([Str::replace('{geofence_id}', $user->apps()->first()->geofences()->first()->id, GeofenceCacheKeysEnum::GEOFENCE_ID_KEY->value)]);

        Redis::shouldReceive('GET')
            ->with($geofencingService->appGeofencesCacheService->getGeofencePolygoneCacheKey($user->apps()->first()->geofences()->first()->id))
            ->andReturn(
                '{"type":"Polygon","coordinates":[[[1,1],[1,2],[2,2],[2,1],[1,1]]]}'
            );

        Cache::shouldReceive('get')
            ->with($deviceGeofenceStateService->getKey($user->devices()->first()), [])
            ->andReturn([]);
        Bus::fake();
        $processGeofence->handle();
        Bus::assertDispatched(CallWebhookJob::class);
    }

    public function test_point_already_in_user_geofences_test(): void
    {
        Cache::spy();
        Queue::fake();
        Redis::shouldReceive('sadd')
            ->once()
            ->andReturn(true);

        Redis::shouldReceive('set')
            ->once()
            ->andReturn(true);
        DeviceType::factory()->count(1)->create();
        $user = User::factory()
            ->has(
                App::factory()->has(
                    Device::factory()->count(1)
                )->count(1)
            )
            ->has(WebhookSignature::factory()->count(1))->create()
            ->first();
        $response = $this->actingAs($user)->post('/api/geofences', [
            'app_id' => $user->apps()->first()->id,
            'name' => 'My test',
            'webhook_url' => 'https://related-snapper-allowed.ngrok-free.app',
            'geometry' => json_encode(['geometry' => (new Polygon([
                new LinearRing([
                    new Point([1, 1]),
                    new Point([1, 2]),
                    new Point([2, 2]),
                    new Point([2, 1]),
                    new Point([1, 1]),
                ]),
            ]))->jsonSerialize()]),
        ]);

        $response->assertJson(
            function (AssertableJson $json) {
                return $json->has('data');
            }
        );

        $this->assertCount(1, App::all());
        $this->assertCount(1, Device::all());
        $this->assertCount(1, Geofence::all());

        $appGeofencesCacheService = new AppGeofencesCacheService;
        $geofencingService = new GeofencingService($appGeofencesCacheService);
        $deviceGeofenceStateService = new DeviceGeofenceStateService;
        $processGeofence = new ProcessGeofence(
            $user->apps()->first(),
            $user->apps()->first()->devices()->first(),
            new Point([1, 1]),
            time(),
            $geofencingService,
            $deviceGeofenceStateService,
            new WebhookService
        );
        Redis::shouldReceive('SMEMBERS')
            ->with($appGeofencesCacheService->getAppFencesCacheKeyByApp($user->apps()->first()))
            ->andReturn([Str::replace('{geofence_id}', $user->apps()->first()->geofences()->first()->id, GeofenceCacheKeysEnum::GEOFENCE_ID_KEY->value)]);

        Redis::shouldReceive('GET')
            ->with($geofencingService->appGeofencesCacheService->getGeofencePolygoneCacheKey($user->apps()->first()->geofences()->first()->id))
            ->andReturn(
                '{"type":"Polygon","coordinates":[[[1,1],[1,2],[2,2],[2,1],[1,1]]]}'
            );

        Cache::shouldReceive('get')
            ->with($deviceGeofenceStateService->getKey($user->devices()->first()), [])
            ->andReturn(['geofence:id:'.$user->apps()->first()->geofences()->first()->id]);
        Bus::fake();
        $processGeofence->handle();
        Bus::assertNotDispatched(CallWebhookJob::class);
    }

    public function test_point_exited_user_geofences_test(): void
    {
        Cache::spy();
        Queue::fake();
        Redis::shouldReceive('sadd')
            ->once()
            ->andReturn(true);

        Redis::shouldReceive('set')
            ->once()
            ->andReturn(true);
        DeviceType::factory()->count(1)->create();
        $user = User::factory()
            ->has(
                App::factory()->has(
                    Device::factory()->count(1)
                )->count(1)
            )->has(WebhookSignature::factory()->count(1))
            ->create()
            ->first();
        $response = $this->actingAs($user)->post('/api/geofences', [
            'app_id' => $user->apps()->first()->id,
            'name' => 'My test',
            'webhook_url' => 'https://related-snapper-allowed.ngrok-free.app',
            'geometry' => json_encode(['geometry' => (new Polygon([
                new LinearRing([
                    new Point([1, 1]),
                    new Point([1, 2]),
                    new Point([2, 2]),
                    new Point([2, 1]),
                    new Point([1, 1]),
                ]),
            ]))->jsonSerialize()]),
        ]);

        $response->assertJson(
            function (AssertableJson $json) {
                return $json->has('data');
            }
        );

        $this->assertCount(1, App::all());
        $this->assertCount(1, Device::all());
        $this->assertCount(1, Geofence::all());

        $appGeofencesCacheService = new AppGeofencesCacheService;
        $geofencingService = new GeofencingService($appGeofencesCacheService);
        $deviceGeofenceStateService = new DeviceGeofenceStateService;
        $processGeofence = new ProcessGeofence(
            $user->apps()->first(),
            $user->apps()->first()->devices()->first(),
            new Point([10, 10]),
            time(),
            $geofencingService,
            $deviceGeofenceStateService,
            new WebhookService
        );
        Redis::shouldReceive('SMEMBERS')
            ->with($appGeofencesCacheService->getAppFencesCacheKeyByApp($user->apps()->first()))
            ->andReturn([Str::replace('{geofence_id}', $user->apps()->first()->geofences()->first()->id, GeofenceCacheKeysEnum::GEOFENCE_ID_KEY->value)]);

        Redis::shouldReceive('GET')
            ->with($geofencingService->appGeofencesCacheService->getGeofencePolygoneCacheKey($user->apps()->first()->geofences()->first()->id))
            ->andReturn(
                '{"type":"Polygon","coordinates":[[[1,1],[1,2],[2,2],[2,1],[1,1]]]}'
            );

        Cache::shouldReceive('get')
            ->with($deviceGeofenceStateService->getKey($user->devices()->first()), [])
            ->andReturn(['geofence:id:'.$user->apps()->first()->geofences()->first()->id]);
        Bus::fake();
        $processGeofence->handle();
        Bus::assertDispatched(CallWebhookJob::class);
    }
}
