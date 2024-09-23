<?php

namespace App\Observers;

use App\Actions\GeopulseQueueAction;
use App\Models\Device;

class DeviceObserver
{
    public function __construct(public GeopulseQueueAction $geopulseQueueAction) {}

    public function created(Device $device): void
    {
        $this->geopulseQueueAction->push('DeviceCreated', ['deviceKey' => $device->key, 'appKey' => $device->app->key]);
    }

    public function deleted(Device $device): void
    {
        $this->geopulseQueueAction->push('DeviceDeleted', ['deviceKey' => $device->key, 'appKey' => $device->app->key]);
    }
}
