<?php

use App\Actions\GeopulseQueueAction;
use App\Jobs\RenewFreeSubscriptionsQuota;
use Illuminate\Support\Facades\Schedule;

// Schedule::job(new RenewFreeSubscriptionsQuota(new GeopulseQueueAction))->everyMinute();
Schedule::command('app:create-site-map')->daily();
