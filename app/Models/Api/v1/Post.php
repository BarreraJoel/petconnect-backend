<?php

namespace App\Models\Api\v1;

use App\Enums\Api\v1\PostTypeEnum;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $primaryKey = 'uuid';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'uuid',
        'title',
        'city',
        'locality',
        'description',
        'images_url',
        'user_id',
        'is_approved',
        'type',
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
            'images_url' => 'array',
            // 'created_at' => 'datetime:d-m-Y H:i:s',
            // 'updated_at' => 'datetime:d-m-Y H:i:s'
        ];
    }
}
