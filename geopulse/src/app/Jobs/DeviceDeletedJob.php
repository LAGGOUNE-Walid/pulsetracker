<?php

namespace Pulse\Jobs;

class DeviceDeletedJob
{

    /**
     * Create a new job instance.
     */
    public function __construct(public $table, public string $appKey, public string $deviceKey)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (! $this->table->exist($this->appKey)) {
            $devices = [];
        }else {
            $devices = json_decode($this->table->get($this->appKey)['devicesKeys'], true);
        }
        $key = array_search($this->deviceKey, $devices);
        if ($key !== false) {
            unset($devices[$key]);
        }
        $this->table->set($this->appKey, ["devicesKeys" => json_encode($devices)]);
    }
}
