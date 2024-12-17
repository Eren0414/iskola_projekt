<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiakRequest extends FormRequest
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
            'osztalyId' => 'required|integer',
            'nev' => 'required|string|min:2',
            'neme' => 'required|boolean',
            'szuletett' => 'date',
            'helyseg' => 'string|min:2',
            'osztondij' => 'numeric',
            'atlag' => 'numeric',
        ];
    }
}
