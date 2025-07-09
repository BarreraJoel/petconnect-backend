<?php

use App\Models\Api\v1\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

require_once __DIR__ . "/auth/auth.php";

Route::get('users', function () {
    $users = User::all();
    $user = User::find('97b7f15a-e9ee-4bd6-8f22-1bccdcf1ddf8');
    // return Hash::check('12345678', (string) $user->password);
    return $users;
});
