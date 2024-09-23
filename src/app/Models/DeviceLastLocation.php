<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceLastLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'app_id',
        'app_key',
        'device_id',
        'device_key',
        'user_id',
        'location',
    ];

    protected $casts = [
        'location' => 'json',
    ];
}
