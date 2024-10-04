<?php

namespace Pulse\Jobs;

use Pulse\Traits\CheckIfUserExistsInCache;
use Swoole\Table;

class AppCreatedJob
{
    use CheckIfUserExistsInCache;

    /**
     * Create a new job instance.
     */
    public function __construct(public Table $appsDevicesTable, public Table $usersQuotaTable, public string $appKey, public int $userId)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $this->appsDevicesTable->set($this->appKey, ['devicesKeys' => json_encode([]), 'userId' => $this->userId]);

            $this->createUserIfNotExists($this->userId, $this->usersQuotaTable);
        } catch (\Throwable $th) {
            \Sentry\captureException($th);
        }
    }
}
