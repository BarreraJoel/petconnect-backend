<?php

namespace App\Policies\Api\v1\User;

use App\Models\Api\v1\User;
use Illuminate\Support\Facades\Log;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $userOne, User $userTwo): bool
    {        
        return $userOne->uuid === $userTwo->uuid;
    }
}
