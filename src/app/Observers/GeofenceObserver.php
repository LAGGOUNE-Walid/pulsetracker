<?php

namespace App\Observers;

use App\Models\Geofence;
use App\Services\AppGeofencesCacheService;

class GeofenceObserver
{
    public function __construct(public AppGeofencesCacheService $appGeofencesCacheService) {}

    public function created(Geofence $geofence): void
    {
        $this->appGeofencesCacheService->create($geofence);
    }

    public function updated(Geofence $geofence): void
    {
        $this->appGeofencesCacheService->update($geofence);
    }

    public function deleted(Geofence $geofence): void
    {
        $this->appGeofencesCacheService->delete($geofence);
    }
}
