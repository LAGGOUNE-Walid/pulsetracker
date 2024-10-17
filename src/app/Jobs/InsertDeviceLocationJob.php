<?php

namespace App\Jobs;

use App\Models\App;
use App\Models\Device;
use GeoJson\Geometry\Point;
use App\Models\DeviceLocation;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class InsertDeviceLocationJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public App $app,
        public Device $device,
        public Point $point,
        public array $data
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DeviceLocation::create([
            'ip_address' => $this->data['ip'],
            'app_id' => $this->app->id,
            'app_key' => $this->app->key,
            'device_id' => $this->device->id,
            'device_key' => $this->device->key,
            'location' => $this->point,
            'user_id' => $this->app->user_id,
            'extra_data' => $this->data['extraData'],
        ]);
    }
}
