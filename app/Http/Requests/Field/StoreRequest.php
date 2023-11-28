<?php

namespace App\Http\Requests\Field;

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
        return isAbleTo('create_field');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'type' => ['required', 'in:text,textarea,number,select,email,tel,date,datetime,time,week,month'],
            'label' => ['required', 'unique:fields', 'string', 'max:70'],
            'name' => ['required', 'unique:fields', 'string', 'max:25'],
            'options' => ['required_if:type,select'],
            'placeholder' => ['nullable', 'string', 'max:100'],
            'help_text' => ['nullable', 'string', 'max:255'],
            'columns' => ['nullable', 'integer', 'min:1', 'max:12'],
            'max_length' => ['nullable', 'required_if:type,text,textarea,email,tel', 'integer', 'max:9999', 'min:0'],
            'min_length' => ['nullable', 'integer', 'max:9999', 'min:0'],
            'required' => ['required', 'boolean'],
            'distinct' => ['required', 'boolean'],
            'is_integer_or_float' => ['required', 'boolean'],
            'is_multiple' => ['required', 'boolean'],
        ];
    }
}