<?php

namespace App\Traits;

use App\Models\User;
use App\Models\UserCurrentQuota;

trait HaveToCreateCurrentUsageQuota
{
    public function createCurrentUsageQuota(User $user): UserCurrentQuota
    {
        return $user->currentUsage()->create(['messages_sent' => 0]);
    }
}
