<?php

namespace Pulse\Jobs;

class AppDeletedJob
{

    /**
     * Create a new job instance.
     */
    public function __construct(public $table, public string $appKey)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->table->del($this->appKey);
    }
}
