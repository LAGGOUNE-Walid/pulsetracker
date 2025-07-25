<?php

namespace App\Models;

use App\Observers\AppObserver;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([AppObserver::class])]
class App extends Model
{
    use CrudTrait;
    use HasFactory, SoftDeletes;

    protected $fillable = ['key', 'name'];

    public function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }

    public function locations(): HasMany
    {
        return $this->hasMany(DeviceLocation::class);
    }

    public function locationsCounts(): HasMany
    {
        return $this->hasMany(AppMonthlyQuota::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function geofences(): HasMany
    {
        return $this->hasMany(Geofence::class);
    }
}
