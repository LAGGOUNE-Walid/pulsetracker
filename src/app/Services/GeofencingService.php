<?php

namespace App\Services;

use App\Models\App;
use GeoJson\Geometry\Point;
use GeoJson\Geometry\Polygon;

class GeofencingService
{
    public function __construct(public AppGeofencesCacheService $appGeofencesCacheService) {}

    public function checkPointInAppFences(Point $point, App $app): array
    {
        $appGeofences = $this->getAppGeofences($app);
        $containingGeofences = $this->findContainingGeofences($appGeofences, $point);

        return $containingGeofences;
    }

    public function getAppGeofences(App $app): array
    {
        return $this->appGeofencesCacheService->get($app);
    }

    public function findContainingGeofences(array $appGeofencesCacheKeys, Point $point): array
    {
        $geofences = [];
        foreach ($appGeofencesCacheKeys as $geofenceCacheKeys) {
            $geofence = $this->appGeofencesCacheService->getGeofence($geofenceCacheKeys);
            if ($this->containsPoint($geofence, $point)) {
                $geofences[$geofenceCacheKeys] = $geofence;
            }
        }

        return $geofences;
    }

    public function containsPoint(Polygon $geofencePolygon, Point $point): bool
    {
        $polygonCoordinates = $geofencePolygon->getCoordinates()[0];
        $pointCoordinates = $point->getCoordinates();

        $x = $pointCoordinates[0];
        $y = $pointCoordinates[1];

        $inside = false;
        $n = count($polygonCoordinates);

        for ($i = 0, $j = $n - 1; $i < $n; $j = $i++) {
            $xi = $polygonCoordinates[$i][0];
            $yi = $polygonCoordinates[$i][1];
            $xj = $polygonCoordinates[$j][0];
            $yj = $polygonCoordinates[$j][1];

            if (($xi == $x && $yi == $y) || ($xj == $x && $yj == $y)) {
                return true;
            }

            $intersect = (($yi > $y) != ($yj > $y)) &&
                ($x < ($xj - $xi) * ($y - $yi) / ($yj - $yi) + $xi);

            if ($intersect) {
                $inside = ! $inside;
            }
        }

        return $inside;
    }
}
