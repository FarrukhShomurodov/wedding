<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuestsRequest extends FormRequest
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
            'wedding_id' => 'required|exists:weddings,id'
        ];
    }
}
