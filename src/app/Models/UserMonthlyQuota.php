<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMonthlyQuota extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'month',
        'messages_sent',
        'user_id',
    ];
}
