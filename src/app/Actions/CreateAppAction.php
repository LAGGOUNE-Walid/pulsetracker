<?php

namespace App\Actions;

use App\Models\App;
use App\Models\User;
use Illuminate\Support\Str;

class CreateAppAction
{
    public function create(User $user, string $name): App
    {
        $app = $user->apps()->create(['name' => $name, 'key' => Str::uuid()]);

        return $app;
    }
}
