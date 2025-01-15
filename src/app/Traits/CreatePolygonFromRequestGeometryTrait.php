<?php

namespace App\Traits;

use GeoJson\GeoJson;
use GeoJson\Geometry\Polygon;

trait CreatePolygonFromRequestGeometryTrait
{
    public function createPolygonFromRequestGeometry(string $geometry): ?Polygon
    {
        try {
            $geometry = json_decode($geometry, true);
        } catch (\Throwable $th) {
            return null;
        }
        
        if (! array_key_exists('geometry', $geometry)) {
            return null;
        }
        try {
            
            $polygon = GeoJson::jsonUnserialize($geometry['geometry']);
        } catch (\Throwable $th) {
            return null;
        }

        if (! $polygon instanceof Polygon) {
            return null;
        }

        return $polygon;
    }
}
