<?php

namespace App\Models\Api\v1;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Api\v1\UserTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Clase contenedora de los atributos de un usuario
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\Api\v1\UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'uuid';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'uuid',
        'username',
        'email',
        'password',
        'image_url',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'instagram_url',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime:d-m-Y H:i:s',
            'password' => 'hashed',
            'created_at' => 'datetime:d-m-Y H:i:s',
            'updated_at' => 'datetime:d-m-Y H:i:s'
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('uuid', $value)
            ->orWhere('username', $value)
            ->firstOrFail();
    }
}
