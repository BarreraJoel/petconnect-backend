<?php

namespace App\Classes\Api\v1\Dto\User;

use Spatie\LaravelData\Data;

/**
 * Dto para manejar el inicio de sesión de un User
 */
class LoginUserDto extends Data
{
    /**
     * 
     * @param string $email Email del usuario
     * @param string $password Contraseña del usuario
     */
    public function __construct(
        public string $email,
        public string $password,
    ) {}
}
