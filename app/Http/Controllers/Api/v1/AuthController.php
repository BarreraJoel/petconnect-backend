<?php

namespace App\Http\Controllers\Api\v1;

use App\Classes\Api\v1\ApiResponse;
use App\Classes\Api\v1\Dto\User\LoginUserDto;
use App\Classes\Api\v1\Dto\User\RegisterUserDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Auth\LoginRequest;
use App\Http\Requests\Api\v1\Auth\RegisterRequest;
use App\Http\Resources\Api\v1\Users\UserResource;
use App\Services\Api\v1\AuthService;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

/**
 * Controlador para gestionar la autenticación de usuarios
 */
class AuthController extends Controller
{
    /**
     * 
     * @var AuthService
     */
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    /**
     * Loguea un usuario con email y password
     * @param \App\Http\Requests\Api\v1\Auth\LoginRequest $loginRequest Request validado para iniciar sesión
     * @throws \Illuminate\Auth\AuthenticationException Si las credenciales ingresadas no son válidas
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $loginRequest)
    {
        $userAuthDto = LoginUserDto::from($loginRequest->validated());

        $user = $this->authService->login($userAuthDto);

        if (!$user) {
            throw new AuthenticationException('Las credenciales ingresadas no son válidas');
        }

        return ApiResponse::response(
            true,
            'Login exitoso !!!',
            [
                'user' => $user
            ]
        );
    }

    /**
     * Registra un usuario
     * @param \App\Http\Requests\Api\v1\Auth\RegisterRequest $registerRequest Request validado para registrar un usuario
     * @throws \Exception
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $registerRequest)
    {
        $userDto = RegisterUserDto::from($registerRequest->validated());

        $user = $this->authService->register($userDto);
        if (!$user) {
            throw new Exception('error');
        }

        return ApiResponse::response(
            true,
            'Usuario registrado !!!',
            [
                'user' => $user
            ],
            HttpFoundationResponse::HTTP_CREATED
        );
    }

    /**
     * Encuentra al usuario logueado actualmente
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function user(Request $request)
    {
        return ApiResponse::response(
            true,
            null,
            [
                'user' => new UserResource($request->user())
            ]
        );
    }

    /**
     * Cierra la sesión de un usuario logueado
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $this->authService->logout();

        return ApiResponse::response(
            true,
            null,
            null,
            HttpFoundationResponse::HTTP_NO_CONTENT
        );
    }
}
