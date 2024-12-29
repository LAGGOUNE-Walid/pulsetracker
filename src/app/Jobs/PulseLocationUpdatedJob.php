<?php

namespace App\Jobs;

use App\Models\App;
use App\Models\Device;
use GeoJson\GeoJson;
use GeoJson\Geometry\Point;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Cache;

class PulseLocationUpdatedJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle($job, array $data)
    {

        $app = $this->getAppByKey($data['appId']);
        $device = $this->getDeviceByKey($data['clientId']);

        GeoJson::jsonUnserialize($data['point']);
        $point = new Point($data['point']['coordinates']);
        InsertDeviceLocationJob::dispatch($app, $device, $point, $data);

        IncrementUserQuota::dispatch($app, $device);
        SetDeviceLastLocation::dispatch($app, $device, $point, $data['extraData']);

        return $job->delete();
    }

    public function getAppByKey(string $key): App
    {
        $app = Cache::get('cached-app-key-'.$key, null);
        if (! $app) {
            $app = App::where('key', $key)->firstOrFail();
            Cache::put('cached-app-key-'.$key, $app);
        }

        return $app;
    }

    public function getDeviceByKey(string $key): Device
    {
        $device = Cache::get('cached-device-key-'.$key, null);
        if (! $device) {
            $device = Device::where('key', $key)->firstOrFail();
            Cache::put('cached-device-key-'.$key, $device);
        }

        return $device;
    }
}
