<?php

namespace App\Http\Requests\Structures\RegionalInspection;

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
        return isAbleTo('create_regional_inspection');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:regional_inspections', 'string', 'max:255'],
            'code' => ['required', 'numeric', 'unique:regional_inspections'],
            'dres' => ['nullable', 'array'],
            'dres.*' => ['exists:dres,id']
        ];
    }
}
