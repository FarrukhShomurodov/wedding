<?php

namespace App\Http\Requests\Post;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'slug' => 'required|string|max:250',
            'title' => 'required|string|max:250',
            'title_description' => 'required|string|max:450',
            'image_url' => 'string',
            'description' => 'required|string',
            'post_category_id' => 'required|exists:post_categories,id'
        ];
    }
}
