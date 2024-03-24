<?php

namespace App\Http\Requests\Structures\RegionalInspection;

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
        return isAbleTo('edit_regional_inspection');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = request()->regional_inspection->id;

        return [
            'name' => ['required', 'unique:regional_inspections,name,' . $id . ',id', 'string', 'max:255'],
            'code' => ['required', 'unique:regional_inspections,code,' . $id . ',id', 'numeric'],
            'dres' => ['nullable', 'array'],
            'dres.*' => ['exists:dres,id']
        ];
    }
}
