<?php

namespace App\Http\Requests\Api\v1\Posts;

use App\Enums\Api\v1\PostTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
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
            'title' => 'required|string',
            'city' => 'required|string',
            'locality' => 'required|string',
            'description' => 'required|string',
            'user_id' => 'required|string|exists:users,uuid',
            'type' => ['required', Rule::in(PostTypeEnum::cases())],
            'images' => 'nullable|array|min:1|max:5',
            'images.*' => 'image',
        ];
    }
}
