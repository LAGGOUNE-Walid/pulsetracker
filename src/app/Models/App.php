<?php

namespace App\Models;

use App\Observers\AppObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy([AppObserver::class])]
class App extends Model
{
    use HasFactory;

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
}
