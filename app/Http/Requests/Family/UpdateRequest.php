<?php

namespace App\Http\Requests\Family;

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
        return isAbleTo('edit_family');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = request()->family->id;

        return [
            'name' => ['required', 'unique:families,name,' . $id . ',id', 'max:255']
        ];
    }
}
