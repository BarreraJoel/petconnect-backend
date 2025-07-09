<?php

namespace App\Classes\Api\v1\Dto;

use Spatie\LaravelData\Data;

class UserAuthDto extends Data
{
    /**
     * 
     * @param string $email
     * @param string $password
     */
    public function __construct(
        public string $email,
        public string $password,
    ) {}
}
