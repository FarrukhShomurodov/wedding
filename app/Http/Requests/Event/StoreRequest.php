<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string|max:200',
            'started_date' => 'required|date',
            'ended_date' => 'required|date',
            'description' => 'required|string',
            //Todo image
            'background_url' => 'required|string',
            'wedding_id' => 'required|exists:weddings,id'
        ];
    }
}
