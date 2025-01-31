<?php

namespace App\Services;

use App\Enums\PointStatusInGeofence;
use App\Models\Device;
use App\Models\Geofence;
use GeoJson\Geometry\Point;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Spatie\WebhookServer\WebhookCall;

class WebhookService
{
    public function send(
        array $geofencesCacheKeys,
        PointStatusInGeofence $pointStatusInGeofence,
        Point $point,
        Device $device,
        int $receivedAt
    ): void {
        $geofences = $this->getGeofencesModels($geofencesCacheKeys);
        foreach ($geofences as $geofence) {
            if ($geofence->webhook_url !== null and $geofence->webhook_url !== '' and $geofence->user->webhookSignature !== null) {
                WebhookCall::create()
                    ->url($geofence->webhook_url)
                    ->payload([
                        'event' => $pointStatusInGeofence->value,
                        'point' => json_encode($point),
                        'device_id' => $device->id,
                        'geofence_id' => $geofence->id,
                        'location_received_at' => $receivedAt,
                        'event_sent_at' => time(),
                    ])
                    ->useSecret($geofence->user->webhookSignature->value)
                    ->dispatch();
            }
        }
    }

    public function getGeofencesModels(array $geofencesCacheKeys): Collection
    {
        return Geofence::with('user', 'user.webhookSignature')->whereIn('id', $this->getGeofencesIds($geofencesCacheKeys))->get();
    }

    public function getGeofencesIds(array $geofencesCacheKeys): array
    {
        return array_map(function ($geofenceCacheKey) {
            return Str::afterLast($geofenceCacheKey, ':');
        }, $geofencesCacheKeys);
    }
}
