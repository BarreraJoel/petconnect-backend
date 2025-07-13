<?php

namespace App\Http\Resources\Api\v1\Posts;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
