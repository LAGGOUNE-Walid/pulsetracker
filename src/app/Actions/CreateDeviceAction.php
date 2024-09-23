<?php

namespace App\Actions;

use App\Models\App;
use App\Models\Device;
use App\Models\DeviceType;
use App\Models\User;
use Illuminate\Support\Str;

class CreateDeviceAction
{
    public function create(string $name, User $user, App $app, ?DeviceType $type = null): Device
    {
        $device = $user->devices()->create([
            'name' => $name,
            'app_id' => $app->id,
            'app_key' => $app->key,
            'key' => Str::uuid(),
            'device_type_id' => $type?->id,
        ]);

        return $device;
    }
}
