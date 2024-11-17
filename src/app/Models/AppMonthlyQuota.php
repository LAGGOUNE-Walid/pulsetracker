<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppMonthlyQuota extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'year',
        'month',
        'messages_sent',
        'app_id',
    ];
}
