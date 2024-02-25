<?php

namespace App\Http\Requests\Process;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return isAbleTo('create_process');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'family_id' => ['required', 'exists:families,id'],
            'domain_id' => ['required', 'exists:domains,id'],
            'name' => ['required', 'string', 'max:255', 'unique:processes'],
            'regulations' => ['nullable', 'array'],
            'regulations.*' => ['exists:media,id'],
        ];
    }
}