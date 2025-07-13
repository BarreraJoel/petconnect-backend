<?php

namespace App\Http\Controllers\Api\v1;

use App\Classes\Api\v1\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Users\UserResource;
use App\Models\Api\v1\User;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        
        return ApiResponse::response(
            true,
            null,
            [
                'users' => UserResource::collection($users)
            ],
        );
    }

    public function show(User $user)
    {
        return ApiResponse::response(
            true,
            null,
            [
                'user' => new UserResource($user)
            ],
        );
    }
    
}
