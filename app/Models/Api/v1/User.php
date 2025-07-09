<?php

namespace App\Models\Api\v1;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Api\v1\UserTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'uuid';

    public $incrementing = false;

    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        'email',
        'password',
        'image_url',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime:d-m-Y H:i:s',
            'password' => 'hashed',
            'type' => UserTypeEnum::class,
            'created_at' => 'datetime:d-m-Y H:i:s',
            'updated_at' => 'datetime:d-m-Y H:i:s'
        ];
    }
}
