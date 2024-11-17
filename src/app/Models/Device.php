<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use App\Observers\DeviceObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([DeviceObserver::class])]
class Device extends Model
{
    use CrudTrait;
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'app_id',
        'app_key',
        'key',
        'name',
        'device_type_id',
    ];

    public function app(): BelongsTo
    {
        return $this->belongsTo(App::class);
    }

    public function deviceType(): BelongsTo
    {
        return $this->belongsTo(DeviceType::class);
    }

    public function locations(): HasMany
    {
        return $this->hasMany(DeviceLocation::class);
    }

    public function lastLocation(): HasOne
    {
        return $this->hasOne(DeviceLastLocation::class);
    }

    public function locationsCounts(): HasMany
    {
        return $this->hasMany(DeviceMonthlyQuota::class)->orderByDesc('id');
    }
}
