<?php

namespace Database\Seeders;

use App\Models\DeviceType;
use Illuminate\Database\Seeder;

class DeviceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DeviceType::factory()->count(20)->create();
        DeviceType::create(['name' => 'Smartphone', 'svg' => '']);
        DeviceType::create(['name' => 'Laptop', 'svg' => '']);
        DeviceType::create(['name' => 'Car', 'svg' => '']);
        DeviceType::create(['name' => 'Bus', 'svg' => '']);
        DeviceType::create(['name' => 'Bicycle', 'svg' => '']);
        DeviceType::create(['name' => 'Drone', 'svg' => '']);
        DeviceType::create(['name' => 'Robot', 'svg' => '']);
        DeviceType::create(['name' => 'Smartwatch', 'svg' => '']);
        DeviceType::create(['name' => 'Fleet vehicle', 'svg' => '']);
        DeviceType::create(['name' => 'Boat', 'svg' => '']);
        DeviceType::create(['name' => 'IoT Sensor', 'svg' => '']);
        DeviceType::create(['name' => 'Personal GPS tracker', 'svg' => '']);
        DeviceType::create(['name' => 'Pet Tracker', 'svg' => '']);
        DeviceType::create(['name' => 'Agriculture Equipment', 'svg' => '']);
    }
}
