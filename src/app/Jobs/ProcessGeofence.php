<?php

namespace App\Jobs;

use App\Enums\PointStatusInGeofence;
use App\Models\App;
use App\Models\Device;
use App\Services\DeviceGeofenceStateService;
use App\Services\GeofencingService;
use App\Services\WebhookService;
use GeoJson\Geometry\Point;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessGeofence implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public App $app,
        public Device $device,
        public Point $point,
        public int $receivedAt,
        public GeofencingService $geofencingService,
        public DeviceGeofenceStateService $deviceGeofenceStateService,
        public WebhookService $webhookService
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $insideGeofences = $this->geofencingService->checkPointInAppFences($this->point, $this->app);

        $exitedGeofences = $this->deviceGeofenceStateService->getExited($this->device, $insideGeofences);

        if ($exitedGeofences !== []) {
            $this->webhookService->send($exitedGeofences, PointStatusInGeofence::OUTSIDE, $this->point, $this->device, $this->receivedAt);
        }

        $geofencesNewlyEntered = $this->deviceGeofenceStateService->getGeofencesNewlyEntered($this->device, $insideGeofences);
        if ($geofencesNewlyEntered !== []) {
            $this->webhookService->send($geofencesNewlyEntered, PointStatusInGeofence::INSIDE, $this->point, $this->device, $this->receivedAt);
        }

        $this->deviceGeofenceStateService->set($this->device, $insideGeofences);
    }
}
