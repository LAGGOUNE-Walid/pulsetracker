<?php

namespace App\Observers;

use App\Actions\GeopulseQueueAction;
use App\Models\App;
use App\Services\AppGeofencesCacheService;

class AppObserver
{
    public function __construct(
        public GeopulseQueueAction $geopulseQueueAction,
        public AppGeofencesCacheService $appGeofencesCacheService
    ) {}

    public function created(App $app): void
    {
        $this->geopulseQueueAction->push('AppCreated', ['appKey' => $app->key, 'userId' => $app->user_id]);
    }

    public function deleted(App $app): void
    {
        $this->geopulseQueueAction->push('AppDeleted', ['appKey' => $app->key, 'userId' => $app->user_id]);
        $this->appGeofencesCacheService->deleteByApp($app);
        $app->devices()->delete();
    }
}
