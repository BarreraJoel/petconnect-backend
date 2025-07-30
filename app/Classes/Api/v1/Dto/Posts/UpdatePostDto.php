<?php

namespace App\Classes\Api\v1\Dto\Posts;

use App\Enums\Api\v1\PostTypeEnum;
use Spatie\LaravelData\Data;

/**
 * Dto para manejar datos de una actualización de post
 */
class UpdatePostDto extends Data
{
    /**
     * 
     * @param mixed $title Título del post
     * @param mixed $city Ciudad donde se origina el post
     * @param mixed $locality Localidad donde se origina el post
     * @param mixed $description Breve descripción del post
     * @param mixed $type Tipo de post
     */
    public function __construct(
        public ?string $title,
        public ?string $city,
        public ?string $locality,
        public ?string $description,
        public ?PostTypeEnum $type,
    ) {}
}
