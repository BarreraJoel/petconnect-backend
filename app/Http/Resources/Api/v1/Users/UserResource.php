<?php

namespace App\Http\Resources\Api\v1\Users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $uuid Identificador único del User
 * @property string $username Nombre de usuario del User
 * @property string $email Email del User
 * @property string|null $image_url Imagen de perfil del User
 * @property string|null $facebook_url Url de la red social del User
 * @property string|null $instagram_url Url de la red social del User
 * @property string|null $linkedin_url Url de la red social del User
 * @property string|null $twitter_url Url de la red social del User
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
            'username' => $this->username,
            'email' => $this->email,
            'image_url' => $this->image_url,
            'facebook_url' => $this->facebook_url,
            'instagram_url' => $this->instagram_url,
            'linkedin_url' => $this->linkedin_url,
            'twitter_url' => $this->twitter_url,
        ];
    }
}
