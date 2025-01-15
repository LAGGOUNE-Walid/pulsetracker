<?php

namespace App\Actions;

use App\Models\App;
use App\Models\Geofence;
use App\Traits\GeoJsonPolygonToEloquentSpatialPolygonTrait;
use GeoJson\Geometry\Polygon;

class CreateGeofenceAction
{
    use GeoJsonPolygonToEloquentSpatialPolygonTrait;

    public function create(App $app, Polygon $polygon, string $name, ?string $webhookUrl = null): Geofence
    {
        return $app->geofences()->create([
            'name' => $name,
            'user_id' => $app->user_id,
            'webhook_url' => $webhookUrl,
            'geometry' => $this->geoJsonPolygonToEloquentSpatialPolygon($polygon),
        ]);
    }
}
