<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\AppMonthlyQuota;
use App\Models\Device;
use App\Models\DeviceLocation;
use App\Models\DeviceMonthlyQuota;
use App\Models\User;
use App\Models\UserMonthlyQuota;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::factory()
            ->count(5)
            ->has(
                App::factory()
                    ->count(5)
                    ->has(
                        Device::factory()->count(10)
                            ->has(
                                DeviceLocation::factory()->state(function (array $attr, Device $device) {
                                    return [
                                        'device_id' => $device->id,
                                        'device_key' => $device->key,
                                        'app_key' => $device->app_key,
                                        'app_id' => $device->app_id,
                                        'user_id' => $device->user_id,
                                    ];
                                })->count(100),
                                'locations'
                            )
                            ->has(DeviceMonthlyQuota::factory()->count(1), 'locationsCounts')
                    )
                    ->has(AppMonthlyQuota::factory()->count(1), 'locationsCounts')
            )
            ->has(UserMonthlyQuota::factory()->count(1), 'locationsCounts')
            ->create();
    }
}
