<?php

namespace App\Listeners;

use Illuminate\Support\Carbon;
use App\Models\UserCurrentQuota;
use Laravel\Paddle\Subscription;
use Illuminate\Support\Facades\Log;
use App\Actions\GeopulseQueueAction;
use Laravel\Paddle\Events\WebhookReceived;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaddleEventListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct(
        public GeopulseQueueAction $geopulseQueueAction
    ) {
        //
    }

    public function handle(WebhookReceived $event): void
    {

        if ($event->payload['event_type'] === 'subscription.created' and $event->payload['data']['status'] === 'active') {
            $subscription = Subscription::where('paddle_id', $event->payload['data']['id'])->where('status', 'active')->withWhereHas('billable')->first();
            if ($subscription) {
                $user = $subscription->billable;
                $user->currentSubscription()->update([
                    'type' => $subscription->type,
                    'paddle_id' => $subscription->paddle_id,
                    'price_id' => $event->payload['data']['items'][0]['price']['id'],
                    'starts_at' => Carbon::parse($event->payload['data']['current_billing_period']['starts_at']),
                    'ends_at' => Carbon::parse($event->payload['data']['current_billing_period']['ends_at']),
                ]);
                $this->geopulseQueueAction->push('RefreshUserQuota', ['userId' => $user->id]);
                Log::info("Subscription $subscription->type created to user $user->email");
            }
        }

        if ($event->payload['event_type'] === 'subscription.updated') {
            $subscription = Subscription::where('paddle_id', $event->payload['data']['id'])->withWhereHas('billable')->first();
            if (! $subscription) {
                throw new \Exception('Subscription not found', 1);
            }
            $user = $subscription->billable;
            if ($event->payload['data']['status'] === 'active') {
                $currentUserSubscription = $user->currentSubscription;
                if ($currentUserSubscription->type !== $subscription->type) {
                    $user->currentSubscription()->update([
                        'type' => $subscription->type,
                        'paddle_id' => $subscription->paddle_id,
                        'price_id' => $event->payload['data']['items'][0]['price']['id'],
                    ]);

                    $this->geopulseQueueAction->push('RefreshUserQuota', ['userId' => $user->id]);
                    Log::info("Subscription upgraded/downgraded $subscription->type to user $user->email");
                }

                if (
                    ($currentUserSubscription->starts_at->format('Y-m-d H:i:s') !== Carbon::parse($event->payload['data']['current_billing_period']['starts_at'])->format('Y-m-d H:i:s'))
                    and
                    ($currentUserSubscription->ends_at->format('Y-m-d H:i:s') !== Carbon::parse($event->payload['data']['current_billing_period']['ends_at'])->format('Y-m-d H:i:s'))
                ) {
                    
                    $user->currentSubscription()->update([
                        'starts_at' => Carbon::parse($event->payload['data']['current_billing_period']['starts_at']),
                        'ends_at' => Carbon::parse($event->payload['data']['current_billing_period']['ends_at']),
                    ]);

                    UserCurrentQuota::updateOrCreate(['user_id' => $user->id], ['messages_sent' => 0]);
                    $this->geopulseQueueAction->push('RefreshUserQuota', ['userId' => $user->id]);
                    Log::info("Subscription reinit $subscription->type to user $user->email");
                }
            } else {
                $user->currentSubscription()->update([
                    'type' => 'free',
                    'starts_at' => now(),
                    'ends_at' => now()->addMonth(),
                ]);
                $this->geopulseQueueAction->push('RefreshUserQuota', ['userId' => $user->id]);
                Log::info("Subscription renew $subscription->type to user $user->email");
            }
        }
    }
}
