<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'last_name' => 'required|string|max:70',
            'phone_number' => 'required|regex:/^\+?[0-9]{10,}$/',
            // Todo delete after
            'profile_image',
            'email' => 'required|email',
            'plan_id' => 'exist:plans,id'
        ];
    }
}
