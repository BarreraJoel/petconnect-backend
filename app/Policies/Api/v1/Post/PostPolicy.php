<?php

namespace App\Policies\Api\v1\Post;

use App\Models\Api\v1\Post;
use App\Models\Api\v1\User;
use Illuminate\Support\Facades\Log;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct() {}

    public function update(User $user, Post $post): bool
    {
        // Log::info('post.update init');
        // Log::info($user->toArray());
        // Log::info($post->toArray());
        // Log::info('post.update end');

        return $user->uuid === $post->user_uuid;
    }

    public function destroy(User $user, Post $post): bool
    {
        Log::info('post.destroy');
        return $user->uuid === $post->user_uuid;
    }
    
}
