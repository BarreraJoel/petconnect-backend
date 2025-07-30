<?php

namespace App\Http\Resources\Api\v1\Posts;

use App\Enums\Api\v1\PostTypeEnum;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $uuid Identificador único del post
 * @property string $title Título del post
 * @property string $city Ciudad donde se origina el post
 * @property string $locality Localidad donde se origina el post
 * @property string $description Breve descripción del post
 * @property array $images_url Url de las imagenes del post
 * @property string $user_id Id del usuario propietario del post
 * @property bool $is_approved Si el post fue aprobado por un admin o no
 * @property PostTypeEnum $type Tipo de post
 * @property DateTime $created_at Fecha de creación del post
 * @property DateTime $updated_at Fecha de creación del post
 */
class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'title' => $this->title,
            'city' => $this->city,
            'locality' => $this->locality,
            'description' => $this->description,
            'images_url' => $this->images_url,
            'user_id' => $this->user_id,
            'is_approved' => $this->is_approved,
            'type' => $this->type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
