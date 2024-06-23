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
        $rules = [
            'usable_for_agency' => ['required', 'boolean'],
            'usable_for_dre' => ['required', 'boolean'],
            'is_active' => ['required', 'boolean'],
            'display_priority' => ['required', 'numeric'],
            'update_others_priority' => ['required', 'boolean'],
        ];
        $domain = getDomains(request('domain')->id);

        if ($domain->is_deletable) {
            $rules['name'] = ['required', 'unique:domains,name,' . $id . ',id', 'string', 'max:255'];
            $rules['family_id'] = ['required', 'exists:families,id'];
        }

        return $rules;
    }
}
