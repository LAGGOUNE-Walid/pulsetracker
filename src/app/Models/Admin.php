<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Admin extends Authenticatable
{
    use CrudTrait;

    protected $fillable = ['username', 'password'];

}