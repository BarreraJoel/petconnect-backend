<?php

namespace App\Services\Api\v1;

use App\Classes\Api\v1\Dto\User\LoginUserDto;
use App\Classes\Api\v1\Dto\User\RegisterUserDto;
use App\Models\Api\v1\User;
use Illuminate\Http\UploadedFile;
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
     * @param \App\Classes\Api\v1\Dto\User\LoginUserDto $userAuthDto Contiene los datos para iniciar sesión
     * @return \Illuminate\Foundation\Auth\User|null
     */
    public function login(LoginUserDto $userAuthDto)
    {
        if (!Auth::attempt($userAuthDto->toArray())) {
            return null;
        }
        return Auth::user();
    }

    /**
     * Registro de un usuario
     * @param \App\Classes\Api\v1\Dto\User\RegisterUserDto $userDto Contiene los datos de un nuevo usuario
     * @return User
     */
    public function register(RegisterUserDto $dto): User
    {
        $user = $this->createUser($dto);
        if ($dto->image) {
            $imageUrl = $this->uploadImage($dto->image, $user->uuid, "/users/images/$user->uuid");
            $user->image_url = $imageUrl;
        }

        $user->save();
        return $user;
    }

    private function uploadImage(UploadedFile $image, string $uuid, string $folder)
    {
        $fileService = new FileService();
        $filename = $fileService->generateFileName($uuid);
        $path = $fileService->upload($image, $folder, $filename);

        return $path;
    }

    /**
     * Crea un User
     * @param \App\Classes\Api\v1\Dto\User\RegisterUserDto $userDto Contiene los datos de un nuevo usuario
     * @return User
     */
    private function createUser(RegisterUserDto $userDto)
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
