<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCurrentQuota extends Model
{
    use HasFactory;

    protected $fillable = [
        'messages_sent',
        'user_id',
    ];
}
