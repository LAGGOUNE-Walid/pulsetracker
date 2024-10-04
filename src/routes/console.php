<?php

use App\Actions\GeopulseQueueAction;
use Illuminate\Support\Facades\Schedule;
use App\Jobs\RenewFreeSubscriptionsQuota;

Schedule::job(new RenewFreeSubscriptionsQuota(new GeopulseQueueAction))->everyMinute();
