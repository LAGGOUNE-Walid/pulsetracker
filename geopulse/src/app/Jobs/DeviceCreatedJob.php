<?php

namespace Pulse\Jobs;

use Pulse\Traits\CheckIfUserExistsInCache;
use Swoole\Table;

class DeviceCreatedJob
{
    use CheckIfUserExistsInCache;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Table $appsDevicesTable,
        public Table $usersQuotaTable,
        public string $appKey,
        public string $deviceKey,
        public int $userId
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (! $this->appsDevicesTable->exist($this->appKey)) {
            $devices = [];
        } else {
            $devices = json_decode($this->appsDevicesTable->get($this->appKey)['devicesKeys'], true);
        }
        $devices[] = $this->deviceKey;
        try {
            $this->appsDevicesTable->set($this->appKey, ['devicesKeys' => json_encode($devices), 'userId' => $this->userId]);

            $this->createUserIfNotExists($this->userId, $this->usersQuotaTable);
        } catch (\Throwable $th) {
            \Sentry\captureException($th);
        }
    }
}
