<?php

namespace App\Jobs;

use App\Models\App;
use App\Models\AppMonthlyQuota;
use App\Models\Device;
use App\Models\DeviceMonthlyQuota;
use App\Models\UserMonthlyQuota;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class IncrementUserQuota implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public App $app,
        public Device $device
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::transaction(function () {
            $userMonthlyQuota = UserMonthlyQuota::where('user_id', $this->app->user_id)->where('month', now()->month)->where('year', now()->year)->first();
            if ($userMonthlyQuota) {
                $userMonthlyQuota->increment('messages_sent');
            } else {
                UserMonthlyQuota::cereate([
                    'user_id' => $this->app->user_id,
                    'month' => now()->month,
                    'year' => now()->year,
                    'messages_sent' => 1,
                ]);
            }
            $appMonthlyQuota = AppMonthlyQuota::where('app_id', $this->app->id)->where('month', now()->month)->where('year', now()->year)->first();
            if ($appMonthlyQuota) {
                $appMonthlyQuota->increment('messages_sent');
            } else {
                AppMonthlyQuota::cereate([
                    'app_id' => $this->app->id,
                    'month' => now()->month,
                    'year' => now()->year,
                    'messages_sent' => 1,
                ]);
            }
            $deviceMonthlyQuota = DeviceMonthlyQuota::where('device_id', $this->device->id)->where('month', now()->month)->where('year', now()->year)->first();
            if ($deviceMonthlyQuota) {
                $deviceMonthlyQuota->increment('messages_sent');
            } else {
                DeviceMonthlyQuota::cereate([
                    'device_id' => $this->device->id,
                    'month' => now()->month,
                    'year' => now()->year,
                    'messages_sent' => 1,
                ]);
            }
        });
    }
}
