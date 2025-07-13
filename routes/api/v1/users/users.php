<?php

use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class)
    ->middleware('auth:sanctum');
