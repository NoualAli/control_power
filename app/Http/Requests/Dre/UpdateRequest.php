<?php

namespace App\Http\Requests\Dre;

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
        return isAbleTo('edit_dre');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = request()->dre->id;

        return [
            'name' => ['required', 'unique:roles,name,' . $id . ',id', 'string', 'max:255'],
            'code' => ['required', 'unique:roles,code,' . $id . ',id', 'numeric'],
        ];
    }
}