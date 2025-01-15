<?php

namespace Tests\Feature;

use App\Models\App;
use App\Models\Device;
use App\Models\DeviceLocation;
use App\Models\DeviceType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Queue;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserDevicesTest extends TestCase
{
    use RefreshDatabase;

    public function test_getting_device_api(): void
    {
        Queue::fake();
        DeviceType::factory()->count(1)->create();
        $user = User::factory()->has(
            App::factory()
                ->has(
                    Device::factory()
                        ->count(1)
                )
                ->count(1)
        )->create();
        $response = $this->actingAs($user)->getJson('/api/devices');
        $response->assertJson(
            function (AssertableJson $json) {
                return $json->has('meta')
                    ->has('links')
                    ->has('data', 1);
            }
        );
    }

    public function test_creating_device_api(): void
    {
        Queue::fake();
        DeviceType::factory()->count(1)->create();
        $user = User::factory()->has(App::factory()->count(1))->create();
        $response = $this->actingAs($user)->postJson('/api/devices', [
            'name' => 'foo',
            'app_key' => $user->apps()->first()->key,
            'type_id' => DeviceType::first()->id,
        ]);
        
        $response->assertJson(
            function (AssertableJson $json) {
                return $json->has('data');
            }
        );
    }

    public function test_create_devices_out_of_quota_will_give_error(): void
    {
        Queue::fake();
        DeviceType::factory()->count(1)->create();
        $user = User::factory()->has(App::factory()->count(1))->create();
        $response1 = $this->actingAs($user)->postJson('/api/devices', [
            'name' => 'foo',
            'app_key' => $user->apps()->first()->key,
            'type_id' => DeviceType::first()->id,
        ]);
        $response2 = $this->actingAs($user)->postJson('/api/devices', [
            'name' => 'bar',
            'app_key' => $user->apps()->first()->key,
            'type_id' => DeviceType::first()->id,
        ]);
        $response3 = $this->actingAs($user)->postJson('/api/devices', [
            'name' => 'fuz',
            'app_key' => $user->apps()->first()->key,
            'type_id' => DeviceType::first()->id,
        ]);
        $response1->assertStatus(Response::HTTP_CREATED);
        $response2->assertStatus(Response::HTTP_CREATED);
        $response3->assertStatus(Response::HTTP_CREATED);
        $response4 = $this->actingAs($user)->postJson('/api/devices', [
            'name' => 'Oups',
            'app_key' => $user->apps()->first()->key,
            'type_id' => DeviceType::first()->id,
        ]);
        $response4->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_deleting_device_will_reduce_quota(): void
    {
        Queue::fake();
        DeviceType::factory()->count(1)->create();
        $user = User::factory()->has(App::factory()->count(1))->create();
        $response1 = $this->actingAs($user)->postJson('/api/devices', [
            'name' => 'foo',
            'app_key' => $user->apps()->first()->key,
            'type_id' => DeviceType::first()->id,
        ]);
        $response2 = $this->actingAs($user)->postJson('/api/devices', [
            'name' => 'bar',
            'app_key' => $user->apps()->first()->key,
            'type_id' => DeviceType::first()->id,
        ]);
        $response3 = $this->actingAs($user)->postJson('/api/devices', [
            'name' => 'fuz',
            'app_key' => $user->apps()->first()->key,
            'type_id' => DeviceType::first()->id,
        ]);
        $response1->assertStatus(Response::HTTP_CREATED);
        $response2->assertStatus(Response::HTTP_CREATED);
        $response3->assertStatus(Response::HTTP_CREATED);
        $response4 = $this->actingAs($user)->postJson('/api/devices', [
            'name' => 'Oups',
            'app_key' => $user->apps()->first()->key,
            'type_id' => DeviceType::first()->id,
        ]);
        $response4->assertStatus(Response::HTTP_FORBIDDEN);
        $user->devices()->first()->delete();
        Queue::assertPushed('Pulse\\Jobs\\DeviceDeletedJob');
        $response5 = $this->actingAs($user)->postJson('/api/devices', [
            'name' => 'Pass',
            'app_key' => $user->apps()->first()->key,
            'type_id' => DeviceType::first()->id,
        ]);
        $response5->assertStatus(Response::HTTP_CREATED);
    }

    public function test_create_device_will_push_to_geopulse_queue(): void
    {
        Queue::fake();
        DeviceType::factory()->count(1)->create();
        $user = User::factory()->has(App::factory()->count(1))->create();
        $response1 = $this->actingAs($user)->postJson('/api/devices', [
            'name' => 'foo',
            'app_key' => $user->apps()->first()->key,
            'type_id' => DeviceType::first()->id,
        ]);
        Queue::assertPushed('Pulse\\Jobs\\DeviceCreatedJob');
    }

    public function test_create_device_validation(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->postJson('/api/devices', [
            'name' => null,
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response = $this->actingAs($user)->postJson('/api/devices', [
            'name' => '',
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response = $this->actingAs($user)->postJson('/api/devices', [
            'name' => ' ',
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_update_device_name(): void
    {
        Queue::fake();
        DeviceType::factory()->count(1)->create();
        $user = User::factory()->has(
            App::factory()
                ->has(
                    Device::factory()
                        ->count(1)
                )
                ->count(1)
        )->create();
        $response = $this->actingAs($user)->putJson('/api/devices/'.$user->devices()->first()->key, [
            'name' => 'buz',
        ]);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_getting_device_locations(): void
    {
        Queue::fake();
        DeviceType::factory()->count(1)->create();
        $user = User::factory()->has(
            App::factory()
                ->has(
                    Device::factory()
                        ->has(
                            DeviceLocation::factory()
                                ->count(100),
                            'locations'
                        )
                        ->count(1)
                )
                ->count(1)
        )->create();
        $response = $this->actingAs($user)->getJson('/api/devices/'.$user->devices->first()->key.'/locations');
        $response->assertJson(
            function (AssertableJson $json) {
                return $json->has('meta')
                    ->has('links')
                    ->has('data', 50);
            }
        );
    }
}
