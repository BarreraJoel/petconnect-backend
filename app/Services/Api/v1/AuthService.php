<?php

namespace App\Services\Api\v1;

use App\Classes\Api\v1\Dto\UserAuthDto;
use App\Classes\Api\v1\Dto\UserDto;
use App\Models\Api\v1\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Clase que maneja las funciones necesarias para gestionar la autenticación de usuarios
 */
class AuthService
{
    public function __construct() {}

    /**
     * Logueo de un usuario
     * @param \App\Classes\Api\v1\Dto\UserAuthDto $userAuthDto Contiene los datos para iniciar sesión
     * @return \Illuminate\Foundation\Auth\User|null
     */
    public function login(UserAuthDto $userAuthDto)
    {
        if (!Auth::attempt($userAuthDto->toArray())) {
            return null;
        }
        return Auth::user();
    }

    /**
     * Registro de un usuario
     * @param \App\Classes\Api\v1\Dto\UserDto $userDto Contiene los datos de un nuevo usuario
     * @return User
     */
    public function register(UserDto $userDto)
    {
        $user = $this->createUser($userDto);
        $user->save();
        return $user;
    }

    /**
     * Crea un User
     * @param \App\Classes\Api\v1\Dto\UserDto $userDto Contiene los datos de un nuevo usuario
     * @return User
     */
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

    /**
     * Retorna el usuario logueado
     * @return \Illuminate\Foundation\Auth\User Usuario logueado
     */
    public function user()
    {
        return Auth::user();
    }

    /**
     * Desloguea un usuario
     * @return void
     */
    public function logout()
    {
        Auth::guard('web')->logout();
    }
}
