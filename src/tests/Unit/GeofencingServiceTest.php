<?php

namespace Tests\Unit;

use App\Enums\GeofenceCacheKeysEnum;
use App\Services\AppGeofencesCacheService;
use App\Services\GeofencingService;
use GeoJson\Geometry\Point;
use GeoJson\Geometry\Polygon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;

class GeofencingServiceTest extends TestCase
{
    use RefreshDatabase;

    public $geofencingService;

    protected function setUp(): void
    {
        $this->geofencingService = new GeofencingService(new AppGeofencesCacheService);
    }

    public function test_point_inside_geofence(): void
    {
        $geofencePolygon = Polygon::jsonUnserialize(json_decode('{"type":"Polygon","coordinates":[[[1,1],[2,2],[3,3],[1,1]]]}', true));
        $point = new Point([2, 2]);
        $this->assertTrue($this->geofencingService->containsPoint($geofencePolygon, $point));
    }

    public function test_point_outside_geofence(): void
    {
        $geofencePolygon = Polygon::jsonUnserialize(json_decode('{"type":"Polygon","coordinates":[[[1,1],[2,2],[3,3],[1,1]]]}', true));
        $point = new Point([4, 4]);
        $this->assertFalse($this->geofencingService->containsPoint($geofencePolygon, $point));
    }

    public function test_point_on_edge_geofence(): void
    {
        $geofencePolygon = Polygon::jsonUnserialize(json_decode('{"type":"Polygon","coordinates":[[[1,1],[2,2],[3,3],[1,1]]]}', true));
        $point = new Point([2, 2]);
        $this->assertTrue($this->geofencingService->containsPoint($geofencePolygon, $point));
    }

    public function test_point_on_vertex_geofence(): void
    {
        $geofencePolygon = Polygon::jsonUnserialize(json_decode('{"type":"Polygon","coordinates":[[[1,1],[2,2],[3,3],[1,1]]]}', true));
        $point = new Point([1, 1]);
        $this->assertTrue($this->geofencingService->containsPoint($geofencePolygon, $point));
    }

    public function test_point_closer_to_geofence(): void
    {
        $geofencePolygon = Polygon::jsonUnserialize(json_decode('{"type":"Polygon","coordinates":[[[1,1],[2,2],[3,3],[1,1]]]}', true));
        $point = new Point([1.5, 1.6]);
        $this->assertFalse($this->geofencingService->containsPoint($geofencePolygon, $point));
    }

    public function test_geofencing_on_multiple_geofences(): void
    {
        Cache::spy();
        $appGeofences = [
            Str::replace('{geofence_id}', 1, GeofenceCacheKeysEnum::GEOFENCE_ID_KEY->value),
            Str::replace('{geofence_id}', 2, GeofenceCacheKeysEnum::GEOFENCE_ID_KEY->value),
            Str::replace('{geofence_id}', 3, GeofenceCacheKeysEnum::GEOFENCE_ID_KEY->value),
        ];

        Redis::shouldReceive('GET')
            ->times(3)
            ->with($this->geofencingService->appGeofencesCacheService->getGeofencePolygoneCacheKey(1))
            ->andReturn(
                '{"type":"Polygon","coordinates":[[[1,1],[1,2],[2,2],[2,1],[1,1]]]}'
            );
        Redis::shouldReceive('GET')
            ->times(3)
            ->with($this->geofencingService->appGeofencesCacheService->getGeofencePolygoneCacheKey(2))
            ->andReturn(
                '{"type":"Polygon","coordinates":[[[1,1],[1,2],[3,2],[1,3],[1,1]]]}'
            );
        Redis::shouldReceive('GET')
            ->times(3)
            ->with($this->geofencingService->appGeofencesCacheService->getGeofencePolygoneCacheKey(3))
            ->andReturn(
                '{"type":"Polygon","coordinates":[[[1,1],[1,2],[4,2],[1,4],[1,1]]]}'
            );
        $point = new Point([1, 1]);
        $geofencesContainingPoint = $this->geofencingService->findContainingGeofences($appGeofences, $point);
        $this->assertCount(3, $geofencesContainingPoint);

        $point = new Point([3, 2]);
        $geofencesContainingPoint = $this->geofencingService->findContainingGeofences($appGeofences, $point);
        $this->assertCount(2, $geofencesContainingPoint);

        $point = new Point([1, 4]);
        $geofencesContainingPoint = $this->geofencingService->findContainingGeofences($appGeofences, $point);
        $this->assertCount(1, $geofencesContainingPoint);
    }
}
