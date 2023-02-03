<?php

namespace App\Http\Requests\Agency;

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
        return isAbleTo('edit_agency');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = request()->agency->id;

        return [
            'name' => ['required', 'unique:agencies,name,' . $id . ',id'],
            'code' => ['required', 'numeric', 'unique:agencies,code,' . $id . ',id'],
            'dre_id' => ['required', 'exists:dres,id']
        ];
    }
}