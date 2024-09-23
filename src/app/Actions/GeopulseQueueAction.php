<?php

namespace App\Actions;

use Illuminate\Support\Facades\Queue;

class GeopulseQueueAction
{
    public function push(string $job, array $data): string
    {
        return Queue::push('Pulse\Jobs\\'.$job.'Job', $data, 'geopulse-users-apps');
    }
}
