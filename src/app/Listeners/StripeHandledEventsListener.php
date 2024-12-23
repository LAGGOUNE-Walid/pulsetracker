<?php

namespace App\Listeners;

use App\Actions\GeopulseQueueAction;
use App\Models\UserCurrentQuota;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Events\WebhookHandled;
use Laravel\Cashier\Subscription;
use Stripe\Subscription as StripeSubscription;

class StripeHandledEventsListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct(
        public GeopulseQueueAction $geopulseQueueAction
    ) {
        //
    }

    public function handle(WebhookHandled $event): void
    {
        if ($event->payload['type'] == 'customer.subscription.created') {
            dump('customer.subscription.created : ');
            $this->subscriptionCreated($event);
        }

        if ($event->payload['type'] == 'customer.subscription.updated') {
            dump('customer.subscription.updated : ');
            $this->subscriptionUpdated($event);
        }

        if ($event->payload['type'] == 'customer.subscription.deleted') {
            dump('customer.subscription.deleted : ');
            $this->subscriptionDeleted($event);
        }
    }

    public function subscriptionCreated(WebhookHandled $event): void
    {
        $subscription = Subscription::where('stripe_id', $event->payload['data']['object']['id'])
            ->whereHas('user')
            ->where('stripe_status', StripeSubscription::STATUS_ACTIVE)
            ->first();
        if ($subscription) {
            $user = $subscription->user;
            $type = $this->resolveSubscriptionName($subscription->stripe_price);
            $user->currentSubscription()->update([
                'type' => $type,
                'stripe_id' => $subscription->stripe_id,
                'price_id' => $subscription->stripe_price,
                'starts_at' => Carbon::parse($event->payload['data']['object']['current_period_start']),
                'ends_at' => Carbon::parse($event->payload['data']['object']['current_period_end']),
            ]);
            $this->geopulseQueueAction->push('RefreshUserQuota', ['userId' => $user->id]);
            Log::info("Subscription created of type $type to user $user->email");
        }
    }

    public function subscriptionUpdated(WebhookHandled $event): void
    {
        dump(Subscription::where('stripe_id', $event->payload['data']['object']['id'])->get());
        dump(Subscription::all());
        $subscription = Subscription::where('stripe_id', $event->payload['data']['object']['id'])
            ->whereHas('user')
            // ->where('stripe_status', StripeSubscription::STATUS_ACTIVE)
            ->first();

        if (! $subscription) {
            throw new \Exception('Subscription id '.$event->payload['data']['object']['id'].' not found', 1);
        }

        $user = $subscription->user;
        if ($subscription->stripe_status === StripeSubscription::STATUS_ACTIVE) {

            if (! $subscription->ends_at) {
                $type = $this->resolveSubscriptionName($subscription->stripe_price);
                $userOldSubscription = $user->currentSubscription;
                if (
                    $userOldSubscription->price_id !== $subscription->stripe_price
                ) {
                    // its and upgrade operation
                    $user->currentSubscription()->update([
                        'type' => $type,
                        'stripe_id' => $subscription->stripe_id,
                        'price_id' => $subscription->stripe_price,
                    ]);

                    $this->geopulseQueueAction->push('RefreshUserQuota', ['userId' => $user->id]);
                    Log::info("user $user->email changed subscription to $type");
                }

                if (
                    ($userOldSubscription->starts_at->notEqualTo(Carbon::parse($event->payload['data']['object']['current_period_start'])))
                    and
                    ($userOldSubscription->ends_at->notEqualTo(Carbon::parse($event->payload['data']['object']['current_period_end'])))
                ) {
                    // it's a renew operation
                    $user->currentSubscription()->update([
                        'starts_at' => Carbon::parse($event->payload['data']['object']['current_period_start']),
                        'ends_at' => Carbon::parse($event->payload['data']['object']['current_period_end']),
                    ]);

                    UserCurrentQuota::updateOrCreate(['user_id' => $user->id], ['messages_sent' => 0]);
                    $this->geopulseQueueAction->push('RefreshUserQuota', ['userId' => $user->id]);
                    Log::info("Subscription reinit $type to user $user->email");
                }
            } else {
                // subscription updated to cancelation
            }
        }
    }

    public function subscriptionDeleted(WebhookHandled $event): void
    {
        $subscription = Subscription::where('stripe_id', $event->payload['data']['object']['id'])->whereHas('user')->first();
        if (! $subscription) {
            throw new \Exception('Subscription id '.$event->payload['data']['object']['id'].' not found', 1);
        }
        $user = $subscription->user;
        $user->currentSubscription()->update([
            'type' => 'free',
            'starts_at' => Carbon::parse($event->payload['data']['object']['current_period_start']),
            'ends_at' => Carbon::parse($event->payload['data']['object']['current_period_end']),
        ]);
        $this->geopulseQueueAction->push('RefreshUserQuota', ['userId' => $user->id]);
        Log::info("Subscription move to free of user $user->email");
    }

    public function resolveSubscriptionName(string $stripePrice): ?string
    {
        $subscriptions = config('stripe-subscriptions.plans');
        foreach ($subscriptions as $subscriptionArray) {
            if ($subscriptionArray['price_id'] == $stripePrice) {
                return $subscriptionArray['name'];
            }
        }

        return null;
    }
}
