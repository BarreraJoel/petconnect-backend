<?php

namespace App\Http\Resources\Api\v1\Users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $uuid Identificador único del User
 * @property string $first_name Nombre del User
 * @property string $last_name Apellido del User
 * @property string $email Email del User
 * @property string $image_url Imagen de perfil del User
 * @property string $type Tipo del User
 */
class UserResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'image_url' => $this->image_url,
            'facebook_url' => $this->facebook_url,
            'instagram_url' => $this->instagram_url,
            'linkedin_url' => $this->linkedin_url,
            'twitter_url' => $this->twitter_url,
            // 'type' => $this->type,
        ];
    }
}
