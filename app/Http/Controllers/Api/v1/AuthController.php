<?php

namespace App\Http\Controllers\Api\v1;

use App\Classes\Api\v1\ApiResponse;
use App\Classes\Api\v1\Dto\UserAuthDto;
use App\Classes\Api\v1\Dto\UserDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Auth\LoginRequest;
use App\Http\Requests\Api\v1\Auth\RegisterRequest;
use App\Models\Api\v1\User;
use App\Services\Api\v1\AuthService;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function login(LoginRequest $loginRequest, Response $response)
    {
        $userAuthDto = UserAuthDto::from($loginRequest->validated());

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

    public function register(RegisterRequest $registerRequest, Response $response)
    {
        $userDto = UserDto::from($registerRequest->except('image'));

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

    public function user(Request $request, Response $response)
    {
        $user = User::find('97b7f15a-e9ee-4bd6-8f22-1bccdcf1ddf8');

        return ApiResponse::response(
            true,
            null,
            [
                'user' => $user
            ]
        );
    }

    public function logout(Request $request, Response $response)
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
