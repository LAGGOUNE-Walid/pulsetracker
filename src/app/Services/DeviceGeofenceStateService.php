<?php

namespace App\Services;

use App\Enums\GeofenceCacheKeysEnum;
use App\Models\Device;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class DeviceGeofenceStateService
{
    public function set(Device $device, array $geofences): void
    {
        Cache::set($this->getKey($device), array_keys($geofences));
    }

    public function get(Device $device): array
    {
        return Cache::get($this->getKey($device), []);
    }

    public function check(Device $device, string $geofence): bool
    {
        return in_array($geofence, $this->get($device));
    }

    public function getExited(Device $device, array $geofences): array
    {
        return array_values(array_diff($this->get($device), array_keys($geofences)));
    }

    public function getGeofencesNewlyEntered(Device $device, array $geofences): array
    {
        return array_values(array_diff(array_keys($geofences), $this->get($device)));
    }

    public function getKey(Device $device): string
    {
        return Str::replace('{device_id}', $device->id, GeofenceCacheKeysEnum::DEVICE_GEOFENCES_STATE->value);
    }
}
