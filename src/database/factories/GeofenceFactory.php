<?php

namespace Database\Factories;

use App\Models\App;
use Illuminate\Database\Eloquent\Factories\Factory;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Objects\Polygon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Geofence>
 */
class GeofenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'webhook_url' => 'https://pulsestracker.com',
            'user_id' => function (array $attributes) {
                return App::find($attributes['app_id'])->user_id;
            },
            'geometry' => (new Polygon([
                new LineString([
                    new Point(1, 1),
                    new Point(2, 2),
                    new Point(3, 3),
                    new Point(1, 1),
                ]),
            ])),
        ];
    }
}
