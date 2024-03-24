<?php

namespace App\Http\Requests\Structures\Dre;

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
        return isAbleTo('create_dre');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:dres', 'string', 'max:255'],
            'code' => ['required', 'numeric', 'unique:dres'],
            'is_for_testing' => ['required', 'boolean'],
        ];
    }
}
