<?php

namespace App\Classes\Api\v1\Dto;

use App\Enums\Api\v1\UserTypeEnum;
use Spatie\LaravelData\Data;

/**
 * Dto para manejar el registro de un User
 */
class UserDto extends Data
{
    /**
     * 
     * @param string $email Email del usuario
     * @param string $password Contraseña del usuario
     * @param string $first_name Nombre del usuario
     * @param string $last_name Nombre del usuario
     * @param string $type Tipo de usuario
     */
    public function __construct(
        public string $email,
        public string $password,
        public string $first_name,
        public string $last_name,
        public UserTypeEnum $type,
    ) {}
}
