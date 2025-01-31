<?php

namespace App\Services;

use App\Enums\GeofenceCacheKeysEnum;
use App\Models\App;
use App\Models\Geofence;
use GeoJson\Geometry\Polygon;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class AppGeofencesCacheService
{
    public function create(Geofence $geofence): void
    {
        Redis::sadd(
            $this->getAppFencesCacheKeyByGeofence($geofence),
            $this->getGeofenceIdKey($geofence->id)
        );
        Redis::set(
            $this->getGeofencePolygoneCacheKey($geofence->id),
            $geofence->geometry->toJson()
        );
    }

    public function update(Geofence $geofence): void
    {
        if ($geofence->wasChanged('app_id')) {
            $oldAppId = $geofence->getOriginal('app_id');
            $appFencesCacheKey = Str::replace('{app_id}', $oldAppId, GeofenceCacheKeysEnum::APP_KEY->value);
            Redis::srem($appFencesCacheKey, $this->getGeofenceIdKey($geofence->id));
        }
        $this->create($geofence);
    }

    public function delete(Geofence $geofence): void
    {
        Redis::srem($this->getAppFencesCacheKeyByGeofence($geofence), $this->getGeofenceIdKey($geofence->id));
        Redis::del($this->getGeofencePolygoneCacheKey($geofence->id), $geofence->geometry->toJson());
    }

    public function deleteByApp(App $app): void
    {
        $geofences = $app->geofences;
        foreach ($geofences as $geofence) {
            $this->delete($geofence);
        }
    }

    public function get(App $app): array
    {
        return Redis::SMEMBERS($this->getAppFencesCacheKeyByApp($app));
    }

    public function getGeofence(string $geofenceCacheKey): Polygon
    {
        $geofenceId = (int) Str::afterLast($geofenceCacheKey, ':');

        return Polygon::jsonUnserialize(
            json_decode(
                Redis::GET($this->getGeofencePolygoneCacheKey($geofenceId)),
                true
            )
        );
    }

    public function getAppFencesCacheKeyByGeofence(Geofence $geofence): string
    {
        return $this->getAppFencesCache($geofence->app_id);
    }

    public function getAppFencesCacheKeyByApp(App $app): string
    {
        return $this->getAppFencesCache($app->id);
    }

    public function getAppFencesCache(int $appId): string
    {
        return Str::replace('{app_id}', $appId, GeofenceCacheKeysEnum::APP_KEY->value);
    }

    public function getGeofencePolygoneCacheKey(int $geofenceId): string
    {
        return Str::replace('{geofence_id}', $geofenceId, GeofenceCacheKeysEnum::GEOFENCE_POLYGON_KEY->value);
    }

    public function getGeofenceIdKey(int $geofenceId): string
    {
        return Str::replace('{geofence_id}', $geofenceId, GeofenceCacheKeysEnum::GEOFENCE_ID_KEY->value);
    }

    public function getGeofenceIdFromCacheKey(string $geofenceIdKey): string
    {
        return Str::afterLast($geofenceIdKey, ':');
    }
}
