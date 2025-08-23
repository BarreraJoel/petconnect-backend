<?php

namespace App\Classes\Api\v1\Dto\User;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;

/**
 * Dto para manejar el registro de un User
 */
class UpdateUserDto extends Data
{
    public function __construct(
        public ?string $email,
        public ?string $password,
        public ?string $first_name,
        public ?string $last_name,
        public ?string $instagram_url,
        public ?string $facebook_url,
        public ?string $linkedin_url,
        public ?string $twitter_url,
    ) {}
}
