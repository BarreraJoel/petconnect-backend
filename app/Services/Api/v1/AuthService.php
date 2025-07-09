<?php

namespace App\Services\Api\v1;

use App\Classes\Api\v1\Dto\UserAuthDto;
use App\Classes\Api\v1\Dto\UserDto;
use App\Models\Api\v1\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthService
{
    /**
     * 
     */
    public function __construct() {}

    public function login(UserAuthDto $userAuthDto)
    {
        if (!Auth::attempt($userAuthDto->toArray())) {
            return null;
        }
        return Auth::user();
    }

    public function register(UserDto $userDto)
    {
        $user = $this->createUser($userDto);
        $user->save();
        return $user;
    }

    private function createUser(UserDto $userDto)
    {
        $passwordHashed = Hash::make($userDto->password);
        $user = new User([
            'uuid' => Str::uuid()->toString(),
            'password' => $passwordHashed,
        ]);
        $user->fill($userDto->all());

        return $user;
    }

    public function user()
    {
        return Auth::user();
    }

    public function logout()
    {
        Auth::guard('web')->logout();
    }
}
