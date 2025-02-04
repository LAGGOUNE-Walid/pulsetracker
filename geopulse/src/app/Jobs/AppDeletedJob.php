<?php

namespace Pulse\Jobs;

use Pulse\Traits\CheckIfUserExistsInCache;
use Swoole\Table;

class AppDeletedJob
{
    use CheckIfUserExistsInCache;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Table $appsDevicesTable,
        public Table $usersQuotaTable,
        public Table $deviceAppsTable,
        public string $appKey,
        public int $userId
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $this->appsDevicesTable->del($this->appKey);

            $this->createUserIfNotExists($this->userId, $this->usersQuotaTable);
        } catch (\Throwable $th) {
            \Sentry\captureException($th);
        }
    }
}
