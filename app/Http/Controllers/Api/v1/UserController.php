<?php

namespace App\Http\Controllers\Api\v1;

use App\Classes\Api\v1\ApiResponse;
use App\Classes\Api\v1\Dto\User\UpdateUserDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\User\UpdateUserRequest;
use App\Http\Resources\Api\v1\Users\UserResource;
use App\Models\Api\v1\User;
use App\Services\Api\v1\UserService;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controlador para gestionar usuarios
 */
class UserController extends Controller
{

    public function __construct(private UserService $userService) {}

    /**
     * Obtiene y retorna todos los usuarios
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
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

    /**
     * Actualiza un usuario
     * @param \App\Http\Requests\Api\v1\User\UpdateUserRequest $request Request validado para actualizar el usuario
     * @param \App\Models\Api\v1\User $user Usuario a actualizar
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // dd($request->all());
        $dto = UpdateUserDto::from($request->validated());
        $userUpdated = $this->userService->update($dto, $user);

        if (!$userUpdated) {
            return ApiResponse::response(
                false,
                null,
                null,
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return ApiResponse::response(
            true,
            null,
            null,
            Response::HTTP_NO_CONTENT
        );
    }
}
