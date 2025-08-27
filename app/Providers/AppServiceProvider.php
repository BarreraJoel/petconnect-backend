<?php

namespace App\Providers;

use App\Policies\Api\v1\Post\PostPolicy;
use App\Policies\Api\v1\User\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('user.update', [UserPolicy::class, 'update']);
        Gate::define('post.update', [PostPolicy::class, 'update']);
        Gate::define('post.destroy', [PostPolicy::class, 'destroy']);
    }
}
