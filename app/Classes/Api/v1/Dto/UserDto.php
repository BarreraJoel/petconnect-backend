<?php

namespace App\Classes\Api\v1\Dto;

use App\Enums\Api\v1\UserTypeEnum;
use Spatie\LaravelData\Data;

class UserDto extends Data
{
    /**
     * 
     * @param string $email
     * @param string $password
     * @param string $name
     * @param string $lastName
     * @param \App\Enums\Api\v1\UserTypeEnum $type
     * @param mixed $imageUrl
     */
    public function __construct(
        public string $email,
        public string $password,
        public string $first_name,
        public string $last_name,
        public UserTypeEnum $type,
        public ?string $image_url,
    ) {}
}
