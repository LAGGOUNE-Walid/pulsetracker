<?php

namespace Database\Factories;

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
        return [
            'ip_address' => fake()->ipv4(),
            'location' => json_encode(new Point([fake()->longitude(), fake()->latitude()])),
        ];
    }
}
