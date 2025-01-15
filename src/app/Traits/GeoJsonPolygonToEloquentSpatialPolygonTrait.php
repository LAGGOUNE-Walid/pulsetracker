<?php

namespace App\Traits;

use GeoJson\Geometry\Polygon;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Objects\Polygon as PolygonElequentSpatial;

trait GeoJsonPolygonToEloquentSpatialPolygonTrait
{
    public function geoJsonPolygonToEloquentSpatialPolygon(Polygon $polygon): PolygonElequentSpatial
    {
        $points = [];
        foreach ($polygon->getCoordinates() as $coordinateGroups) {
            foreach ($coordinateGroups as $coordinate) {
                $points[] = new Point($coordinate[0], $coordinate[1]);
            }
        }

        return new PolygonElequentSpatial([
            new LineString($points),
        ]);
    }
}
