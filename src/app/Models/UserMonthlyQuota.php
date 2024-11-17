<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMonthlyQuota extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'year',
        'month',
        'messages_sent',
        'user_id',
    ];
}
