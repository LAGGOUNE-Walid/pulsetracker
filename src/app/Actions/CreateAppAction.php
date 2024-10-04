<?php

namespace App\Actions;

use App\Models\App;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CreateAppAction
{
    public function create(User $user, string $name): App
    {
        $app = $user->apps()->create(['name' => $name, 'key' => Str::uuid()]);
        Log::info("App create of $user->email");
        return $app;
    }
}
