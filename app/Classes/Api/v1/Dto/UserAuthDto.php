<?php

namespace App\Classes\Api\v1\Dto;

use Spatie\LaravelData\Data;

/**
 * Dto para manejar el inicio de sesión de un User
 */
class UserAuthDto extends Data
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
