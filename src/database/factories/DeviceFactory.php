<?php

namespace Database\Factories;

use App\Models\App;
use App\Models\DeviceType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function (array $attributes) {
                return App::find($attributes['app_id'])->user_id;
            },
            'app_key' => function (array $attributes) {
                return App::find($attributes['app_id'])->key;
            },
            'key' => Str::uuid(),
            'name' => Str::random(6),
            'device_type_id' => DeviceType::all()->random(1)->first()->id,
        ];
    }
}
