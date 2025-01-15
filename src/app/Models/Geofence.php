<?php

namespace App\Models;

use App\Observers\GeofenceObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MatanYadaev\EloquentSpatial\Objects\Polygon;

#[ObservedBy([GeofenceObserver::class])]
class Geofence extends Model
{
    protected $fillable = [
        'name',
        'app_id',
        'user_id',
        'webhook_url',
        'geometry',
    ];

    protected $casts = [
        'geometry' => Polygon::class,
    ];

    public function app(): BelongsTo
    {
        return $this->belongsTo(App::class);
    }
}
