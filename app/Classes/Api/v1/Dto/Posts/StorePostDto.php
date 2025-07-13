<?php

namespace App\Classes\Api\v1\Dto\Posts;

use App\Enums\Api\v1\PostTypeEnum;
use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;

class StorePostDto extends Data
{
    /**
     * 
     * @param string $title
     * @param string $city
     * @param string $locality
     * @param string $description
     * @param string $user_id
     * @param \App\Enums\Api\v1\PostTypeEnum $type
     * @param mixed $images
     */
    public function __construct(
        public string $title,
        public string $city,
        public string $locality,
        public string $description,
        public string $user_id,
        public PostTypeEnum $type,
        public ?array $images,
    ) {}
}
