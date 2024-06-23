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
        $rules = [
            'usable_for_agency' => ['required', 'boolean'],
            'usable_for_dre' => ['required', 'boolean'],
            'is_active' => ['required', 'boolean'],
            'display_priority' => ['required', 'numeric'],
            'update_others_priority' => ['required', 'boolean'],
        ];
        $family = getFamilies(request('family')->id);
        if (!$family->is_deletable) {
            $rules['name'] = ['required', 'unique:families,name,' . $id . ',id', 'string', 'max:255'];
            // $rules['code'] = ['nullable', 'unique:families,code,' . $id . ',id', 'string', 'max:20'];
        }

        return $rules;
    }
}
