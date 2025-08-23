<?php

namespace App\Services\Api\v1;

use App\Classes\Api\v1\Dto\User\UpdateUserDto;
use App\Models\Api\v1\User;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    public function update(UpdateUserDto $dto, User $user)
    {
        $attributes = array_filter([
            'email' => $dto->email,
            'password' => $dto->password,
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name,
            'instagram_url' => $dto->instagram_url,
            'facebook_url' => $dto->facebook_url,
            'linkedin_url' => $dto->linkedin_url,
            'twitter_url' => $dto->twitter_url,
        ], fn($value) => !is_null($value));

        $user->fill($attributes);
        // dd($user);
        $user->save();

        return $user;
    }
}
