<?php

namespace App\Models\Api\v1;

use App\Enums\Api\v1\PostTypeEnum;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'city',
        'locality',
        'description',
        'image_url',
        'user_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => PostTypeEnum::class,
            'is_approved' => 'boolean',
            'created_at' => 'datetime:d-m-Y',
            'updated_at' => 'datetime:d-m-Y'
        ];
    }
}
