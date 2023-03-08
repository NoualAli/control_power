<?php

namespace App\Http\Requests\Agency;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => ['required', 'unique:agencies,name,' . $id],
            'code' => ['required', 'numeric', 'unique:agencies,code,' . $id],
            'dre_id' => ['required', 'exists:dres,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'pcf_usable' => ['nullable', 'array'],
            'pcf_usable.*' => [Rule::notIn(request()->pcf_usnuable)],
            'pcf_unusable' => ['nullable', 'array'],
            'pcf_unusable.*' => [Rule::notIn(request()->pcf_usable)],
        ];
    }

    // public function attributes()
    // {
    //     // return [
    //     //     'pcf_unusable.*.not_it' => 'pcf_unusable',
    //     // ];
    // }
}