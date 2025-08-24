<?php

namespace App\Http\Requests\Api\v1\Auth;

use App\Enums\Api\v1\UserTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property string $email Email del usuario
 * @property string $password Contraseña del usuario
 * @property string $first_name Nombre del usuario
 * @property string $last_name Nombre del usuario
 * @property string $type Tipo de usuario
 * @property string $image Imagen de perfil del usuario
 */
class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|min:3|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:8|max:8',
            'image' => 'nullable|image',
        ];
    }
}
