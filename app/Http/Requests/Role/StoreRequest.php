<?php

namespace App\Http\Requests\Role;

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
        return isAbleTo('create_role') && hasRole('root');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:roles', 'string', 'max:50'],
            'code' => ['required', 'unique:roles', 'string', 'max:10'],
            // 'permissions' => ['required', 'array'],
            // 'permissions.*' => ['exists:permissions,id']
        ];
    }
}
