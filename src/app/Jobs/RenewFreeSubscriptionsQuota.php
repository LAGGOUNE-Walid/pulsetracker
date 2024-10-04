<?php

namespace App\Jobs;

use Illuminate\Support\Carbon;
use App\Models\UserCurrentQuota;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use App\Actions\GeopulseQueueAction;
use App\Models\CurrentUserSubscription;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class RenewFreeSubscriptionsQuota implements ShouldQueue
{
    use Queueable;

    public Carbon $currentMinute;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public GeopulseQueueAction $geopulseQueueAction
    ) {
        $this->currentMinute = Carbon::now();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        CurrentUserSubscription::where('type', 'free')
            ->whereDate('ends_at', now()->format('Y-m-d'))
            ->chunk(100, function (Collection $currentSubscriptions) {
                foreach ($currentSubscriptions as $currentSubscription) {
                    if ($currentSubscription->ends_at->format('Y-m-d H:i') === $this->currentMinute->format('Y-m-d H:i')) {
                        $currentSubscription->update([
                            'type' => $currentSubscription->type,
                            'starts_at' => Carbon::parse(now()),
                            'ends_at' => Carbon::parse(now()->addMonth()),
                        ]);
                        UserCurrentQuota::updateOrCreate(['user_id' => $currentSubscription->user_id], ['messages_sent' => 0]);
                        $this->geopulseQueueAction->push('RefreshUserQuota', ['userId' => $currentSubscription->user_id]);
                        Log::info("Free Subscription to user {$currentSubscription->user->email}");
                    }
                }
            });
    }
}
