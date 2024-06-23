<?php

namespace App\Http\Requests\PCF;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return hasRole(['admin', 'root', 'cdcr', 'dcp']) || isAbleTo('manage_pcf');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category' => ['required', 'in:Notes,Circulaires,Lettres-circulaire,Guides 1er niveau'],
            'number' => ['nullable', 'string', 'regex:/^\d+(\.?\d+)+?$/'],
            'date' => ['nullable'],
            'object' => ['nullable', 'string', 'max:255'],
            'media' => ['required', 'exists:media,id'],
            'pcf' => ['nullable', 'array']
        ];
    }

    public function messages()
    {
        return [
            'media.required' => 'Le champ texte réglementaire est obligatoire.',
        ];
    }
}
