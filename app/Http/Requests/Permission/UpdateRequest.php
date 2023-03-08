<?php

namespace App\Http\Requests\Permission;

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
        return isAbleTo('edit_permission');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = request()->permission->id;

        return [
            'name' => ['required', 'unique:permissions,name,' . $id . ',id', 'string', 'max:30'],
            'roles' => ['required', 'array'],
            'roles.*' => ['exists:roles,id']
        ];
    }
}