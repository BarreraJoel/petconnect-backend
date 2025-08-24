<?php

namespace App\Models\Api\v1;

use App\Enums\Api\v1\PostTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Clase contenedora de los atributos de un post
 */
class Post extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'uuid',
        'type',
        'title',
        'city',
        'locality',
        'description',
        'slug',
        'images_url',
        'is_approved',
        'user_uuid',
    ];


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

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
}
