<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserQuotaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $subscriptions = config('paddle-subscriptions.plans');
        $userSubscriptionQuota = 0;
        foreach ($subscriptions as $subscription) {
            $allowedDevicesPerSubscription = $subscription['size']['messages_per_month'] ?? PHP_INT_MAX;
            if ($this->subscribed($subscription['name'])) {
                $userSubscriptionQuota = $allowedDevicesPerSubscription;
            }
        }
        if ($userSubscriptionQuota === 0) {
            $userSubscriptionQuota = $subscriptions['free']['size']['messages_per_month'];
        }

        return [
            'id' => $this->id,
            'quota' => $userSubscriptionQuota,
            'used' => ($this->locationsCounts?->first()?->messages_sent ?? 0),
            'left' => $userSubscriptionQuota - ($this->locationsCounts?->first()?->messages_sent ?? 0),
        ];
    }
}
