<?php

namespace Tests\Feature;

use App\Models\App;
use App\Models\Device;
use App\Models\DeviceType;
use App\Models\User;
use App\Services\DeviceGeofenceStateService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class DeviceGeofenceStateServiceTest extends TestCase
{
    use RefreshDatabase;

    public $deviceGeofenceStateService;

    protected function setUp(): void
    {
        $this->deviceGeofenceStateService = new DeviceGeofenceStateService;
        parent::setUp();
    }

    public function test_getting_geofences_newly_entered(): void
    {
        Queue::fake();
        DeviceType::factory()->count(1)->create();
        $user = User::factory()->has(
            App::factory()->count(5)->has(
                Device::factory()->count(10)
            )
        )->create()->first();
        $device = Device::first();

        Cache::shouldReceive('get')
            ->once()
            ->with($this->deviceGeofenceStateService->getKey($device), [])
            ->andReturn(['g-id-1', 'g-id-2']);

        $this->assertEquals(
            ['g-id-3'],
            $this->deviceGeofenceStateService->getGeofencesNewlyEntered(
                $device,
                [
                    'g-id-1' => 'geofence:1',
                    'g-id-2' => 'geofence:2',
                    'g-id-3' => 'geofence:3',
                ]
            )
        );

        Cache::shouldReceive('get')
            ->once()
            ->with($this->deviceGeofenceStateService->getKey($device), [])
            ->andReturn(['g-id-1', 'g-id-2']);

        $this->assertEquals([], $this->deviceGeofenceStateService->getGeofencesNewlyEntered($device, [
            'g-id-1' => 'geofence:1',
            'g-id-2' => 'geofence:2',
        ]));

        Cache::shouldReceive('get')
            ->once()
            ->with($this->deviceGeofenceStateService->getKey($device), [])
            ->andReturn(['g-id-1']);

        $this->assertEquals(['g-id-2', 'g-id-4', 'g-id-3'], $this->deviceGeofenceStateService->getGeofencesNewlyEntered(
            $device,
            [
                'g-id-1' => 'geofence:1',
                'g-id-2' => 'geofence:2',
                'g-id-4' => 'geofence:4',
                'g-id-3' => 'geofence:3',
            ]
        ));
    }

    public function test_getting_geofences_exited(): void
    {
        Queue::fake();
        DeviceType::factory()->count(1)->create();
        $user = User::factory()->has(
            App::factory()->count(5)->has(
                Device::factory()->count(10)
            )
        )->create()->first();
        $device = Device::first();

        Cache::shouldReceive('get')
            ->once()
            ->with($this->deviceGeofenceStateService->getKey($device), [])
            ->andReturn(['g-id-1', 'g-id-2']);

        $this->assertEquals(['g-id-2'], $this->deviceGeofenceStateService->getExited($device, ['g-id-1' => 'geofence:1']));

        Cache::shouldReceive('get')
            ->once()
            ->with($this->deviceGeofenceStateService->getKey($device), [])
            ->andReturn(['g-id-1', 'g-id-2']);

        $this->assertEquals(['g-id-1', 'g-id-2'], $this->deviceGeofenceStateService->getExited($device, []));

        Cache::shouldReceive('get')
            ->once()
            ->with($this->deviceGeofenceStateService->getKey($device), [])
            ->andReturn(['g-id-1', 'g-id-2']);

        $this->assertEquals([], $this->deviceGeofenceStateService->getExited($device, ['g-id-1' => 'geofence:1', 'g-id-2' => 'geofence:2', 'g-id-3' => 'geofence:3']));

        Cache::shouldReceive('get')
            ->once()
            ->with($this->deviceGeofenceStateService->getKey($device), [])
            ->andReturn(['g-id-1', 'g-id-2']);

        $this->assertEquals(['g-id-2'], $this->deviceGeofenceStateService->getExited($device, ['g-id-1' => 'geofence:1', 'g-id-3' => 'geofence:3']));
    }
}
