<?php

namespace App\Http\Requests\Api\v1\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'email',
            'password' => 'string|min:8|max:8',
            'first_name' => 'alpha|min:3',
            'last_name' => 'alpha|min:3',
            'image' => 'nullable|image',
            'instagram_url' => 'url:https',
            'facebook_url' => 'url:https',
            'linkedin_url' => 'url:https',
            'twitter_url' => 'url:https',
            // 'phone_number' => 'string|min:12|max:12',
        ];
    }
}
