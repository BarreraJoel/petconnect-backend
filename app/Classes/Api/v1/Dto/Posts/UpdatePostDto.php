<?php

namespace App\Classes\Api\v1\Dto\Posts;

use App\Enums\Api\v1\PostTypeEnum;
use Spatie\LaravelData\Data;

class UpdatePostDto extends Data
{
    /**
     * 
     * @param mixed $title
     * @param mixed $city
     * @param mixed $locality
     * @param mixed $description
     * @param mixed $user_id
     * @param mixed $type
     */
    public function __construct(
        public ?string $title,
        public ?string $city,
        public ?string $locality,
        public ?string $description,
        public ?PostTypeEnum $type,
    ) {}
}
