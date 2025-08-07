<?php

use App\Http\Controllers\Api\v1\PostController;
use Illuminate\Support\Facades\Route;

Route::get('posts/user/{id}', [PostController::class, 'showByUserId']);

Route::apiResource('posts', PostController::class)
    ->middleware('auth:sanctum');
