<?php

namespace Database\Factories;

use App\Models\Device;
use GeoJson\Geometry\Point;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeviceLocation>
 */
class DeviceLocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 'ip_address',
        // 'app_id',
        // 'app_key',
        // 'device_id',
        // 'device_key',
        // 'user_id',
        // 'location',
        // 'extra_data',
        return [
            'location' => json_encode(new Point([fake()->longitude(), fake()->latitude()])),
            'device_key' => function (array $attributes) {
                return Device::find($attributes['device_id'])->key;
            },
            'device_id' => function (array $attributes) {
                return $attributes['device_id'];
            },
            'user_id' => function (array $attributes) {
                return Device::find($attributes['device_id'])->user_id;
            },
            'app_key' => function (array $attributes) {
                return Device::find($attributes['device_id'])->app_key;
            },
            'app_id' => function (array $attributes) {
                return Device::find($attributes['device_id'])->app_id;
            },
            'extra_data' => [
                "speed" => rand(100, 120)
            ]
        ];
    }
}
