<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceMonthlyQuota extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'month',
        'messages_sent',
        'device_id',
    ];
}
