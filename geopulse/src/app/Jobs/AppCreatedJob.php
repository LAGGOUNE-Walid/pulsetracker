<?php

namespace Pulse\Jobs;

class AppCreatedJob
{

    /**
     * Create a new job instance.
     */
    public function __construct(public $table, public string $appKey, public int $userId)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->table->set($this->appKey, ['devicesKeys' => json_encode([]), 'userId' => $this->userId]);
    }
}
