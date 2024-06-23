<?php

namespace App\Http\Requests\Family;

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
        return isAbleTo('create_family');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:families', 'string', 'max:255'],
            'code' => ['nullable', 'unique:families', 'string', 'max:20'],
            'usable_for_agency' => ['required', 'boolean'],
            'usable_for_dre' => ['required', 'boolean'],
            'is_active' => ['required', 'boolean'],
            'display_priority' => ['required', 'numeric'],
        ];
    }
}
