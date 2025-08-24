<?php

namespace App\Classes\Api\v1\Dto\Posts;

use App\Enums\Api\v1\PostTypeEnum;
use Illuminate\Support\Str;
use Spatie\LaravelData\Data;

/**
 * Dto para manejar datos de un nuevo post
 */
class StorePostDto extends Data
{
    /**
     * 
     * @param string $title Título del post
     * @param string $city Ciudad donde se origina el post
     * @param string $locality Localidad donde se origina el post
     * @param string $description Breve descripción del post
     * @param string $user_uuid Uuid del usuario propietario del post
     * @param PostTypeEnum $type Tipo de post
     * @param array $images Array de imagenes 
     */
    public function __construct(
        public string $title,
        public string $city,
        public string $locality,
        public string $description,
        public string $user_uuid,
        public PostTypeEnum $type,
        public ?array $images,
        public ?string $slug,
    ) {}
}
