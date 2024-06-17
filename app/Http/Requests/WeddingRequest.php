<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class WeddingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'user_id' => Auth::user()->id
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'groom_name' => 'required|string|max:200',
            'groom_information' => 'required|string',
            'bridge_name' => 'required|string|max:200',
            'bridge_information' => 'required|string',
            'date_time' => 'required|date',
            'location' => 'required|string',
            'information_later' => 'required|string',
            'bank_card_number' => 'string'
        ];
    }
}
