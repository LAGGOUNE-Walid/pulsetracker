<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceLastLocation extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'app_id',
        'app_key',
        'device_id',
        'device_key',
        'user_id',
        'location',
        'extra_data',
    ];

    protected $casts = [
        'location' => 'json',
        'extra_data' => 'json',
    ];
}
