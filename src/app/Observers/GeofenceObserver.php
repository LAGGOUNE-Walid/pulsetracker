<?php

namespace App\Observers;

use App\Enums\GeofenceCacheKeysEnum;
use App\Models\Geofence;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class GeofenceObserver
{
    public function getAppFencesCacheKey(Geofence $geofence): string
    {
        return Str::replace('{app_id}', $geofence->app_id, GeofenceCacheKeysEnum::APP_KEY->value);
    }

    public function getGeofenceCacheKey(Geofence $geofence): string
    {
        return Str::replace('{geofence_id}', $geofence->id, GeofenceCacheKeysEnum::GEOFENCE_KEY->value);
    }

    public function created(Geofence $geofence): void
    {
        Redis::sadd($this->getAppFencesCacheKey($geofence), "geofence:id:$geofence->id");
        Redis::set($this->getGeofenceCacheKey($geofence), $geofence->geometry->toJson());
    }

    public function updated(Geofence $geofence): void
    {
        if ($geofence->wasChanged('app_id')) {
            $oldAppId = $geofence->getOriginal('app_id');
            $appFencesCacheKey = Str::replace('{app_id}', $oldAppId, GeofenceCacheKeysEnum::APP_KEY->value);
            Redis::srem($appFencesCacheKey, "geofence:id:$geofence->id");
        }
        $this->created($geofence);
    }

    public function deleted(Geofence $geofence): void
    {
        Redis::srem($this->getAppFencesCacheKey($geofence), "geofence:id:$geofence->id");
        Redis::del($this->getGeofenceCacheKey($geofence), $geofence->geometry->toJson());
    }
}
