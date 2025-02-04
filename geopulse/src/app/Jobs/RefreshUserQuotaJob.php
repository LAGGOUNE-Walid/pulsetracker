<?php

namespace Pulse\Jobs;

use Pulse\Traits\CheckIfUserExistsInCache;
use Swoole\Table;

class RefreshUserQuotaJob
{
    use CheckIfUserExistsInCache;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Table $appsDevicesTable,
        public Table $usersQuotaTable,
        public Table $deviceAppsTable,
        public int $userId
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->refreshUserCache($this->userId, $this->usersQuotaTable);
    }
}
