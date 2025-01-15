<?php

namespace App\Actions;

use App\Models\App;
use App\Models\Geofence;
use App\Traits\GeoJsonPolygonToEloquentSpatialPolygonTrait;
use GeoJson\Geometry\Polygon;

class UpdateGeofenceAction
{
    use GeoJsonPolygonToEloquentSpatialPolygonTrait;

    public function update(Geofence $geofence, App $app, ?Polygon $polygon, string $name, ?string $webhookUrl = null): Geofence
    {
        $geofence->update([
            'name' => $name,
            'app_id' => $app->id,
            'user_id' => $app->user_id,
            'webhook_url' => $webhookUrl,
        ]);
        if ($polygon) {
            $geofence->update(['geometry' => $this->geoJsonPolygonToEloquentSpatialPolygon($polygon)]);
        }

        return $geofence;
    }
}
