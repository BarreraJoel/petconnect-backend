<?php

namespace App\Enums\Api\v1;

enum UserTypeEnum: string
{
    case INDIVIDUAL = "individual";
    case SHELTER = "shelter";
    case ADMIN = "admin";

    public static function toArray(): array
    {
        return array_column(UserTypeEnum::cases(), 'value');
    }
}
