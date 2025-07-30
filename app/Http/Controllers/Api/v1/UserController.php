<?php

namespace App\Http\Controllers\Api\v1;

use App\Classes\Api\v1\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Users\UserResource;
use App\Models\Api\v1\User;

/**
 * Controlador para gestionar usuarios
 */
class UserController extends Controller
{
    /**
     * Obtiene y retorna todos los usuarios
     * @return mixed|\Illuminate\Http\JsonResponse
     */
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

    /**
     * Obtiene un usuario según su uuid
     * @param \App\Models\Api\v1\User $user Usuario obtenido
     * @return mixed|\Illuminate\Http\JsonResponse
     */
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
