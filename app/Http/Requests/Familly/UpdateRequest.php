<?php

namespace App\Http\Requests\Familly;

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
        return isAbleTo('edit_familly');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = request()->familly->id;

        return [
            'name' => ['required', 'unique:famillies,name,' . $id . ',id', 'max:255']
        ];
    }
}