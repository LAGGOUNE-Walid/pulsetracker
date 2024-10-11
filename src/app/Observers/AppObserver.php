<?php

namespace App\Observers;

use App\Actions\GeopulseQueueAction;
use App\Models\App;

class AppObserver
{
    public function __construct(public GeopulseQueueAction $geopulseQueueAction) {}

    public function created(App $app): void
    {
        $this->geopulseQueueAction->push('AppCreated', ['appKey' => $app->key, 'userId' => $app->user_id]);
    }

    public function deleted(App $app): void
    {
        $this->geopulseQueueAction->push('AppDeleted', ['appKey' => $app->key, 'userId' => $app->user_id]);
        $app->devices()->delete();
    }
}
