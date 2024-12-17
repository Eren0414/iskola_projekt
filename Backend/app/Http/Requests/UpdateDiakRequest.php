<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDiakRequest extends FormRequest
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
            'osztalyId' => 'nullable|integer',
            'nev' => 'nullable|string|min:2',
            'neme' => 'nullable|boolean',
            'szuletett' => 'nullable|date',
            'helyseg' => 'nullable|string|min:2',
            'osztondij' => 'nullable|numeric',
            'atlag' => 'nullable|numeric',
        ];
    }
}
