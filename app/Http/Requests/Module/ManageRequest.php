<?php

namespace App\Http\Requests\Module;

use Illuminate\Foundation\Http\FormRequest;

class ManageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return isAbleTo('manage_module');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role' => ['required', 'exists:roles,id'],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['exists:permissions,id'],
        ];
    }
}
