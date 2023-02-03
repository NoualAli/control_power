<?php

namespace App\Http\Requests\Agency;

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
        return isAbleTo('create_agency');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:agencies', 'string', 'max:255'],
            'code' => ['required', 'numeric', 'unique:agencies', 'numeric'],
            'dre_id' => ['required', 'exists:dres,id']
        ];
    }
}