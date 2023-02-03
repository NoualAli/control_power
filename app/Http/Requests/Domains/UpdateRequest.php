<?php

namespace App\Http\Requests\Domains;

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
        return isAbleTo('edit_domain');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = request()->domain->id;
        return [
            'name' => ['required', 'unique:domains,name,' . $id . ',id', 'string', 'max:255'],
            'familly_id' => ['required', 'exists:famillies,id'],
        ];
    }
}