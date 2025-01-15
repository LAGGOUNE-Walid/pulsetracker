<?php

namespace Tests\Feature;

use App\Models\App;
use Tests\TestCase;
use App\Models\User;
use GeoJson\Geometry\Point;
use GeoJson\Geometry\Polygon;
use Illuminate\Http\Response;
use GeoJson\Geometry\LinearRing;
use Stevebauman\Location\Position;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Queue;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserGeofencesTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_geo_fences(): void
    {
        Cache::spy();
        Queue::fake();
        $user = User::factory()->has(App::factory()->count(1))->create()->first();
        $response = $this->actingAs($user)->post("/api/geofences", [
            'app_id' => $user->apps()->first()->id,
            'name' => 'My test',
            'webhook_url' => 'https://www.google.com',
            'geometry' => json_encode(["geometry" => (new Polygon([
                new LinearRing([
                    new Point([1, 1]),
                    new Point([2, 2]),
                    new Point([3, 3]),
                    new Point([1, 1])
                ])
            ]))->jsonSerialize()])
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
        $response = $this->actingAs($user)->post("/api/geofences", [
            'app_id' => $user->apps()->first()->id,
            'name' => 'My test',
            'webhook_url' => 'https://www.google.com',
            'geometry' => json_encode([])
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
