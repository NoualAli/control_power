<?php

namespace App\Http\Requests\Process;

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
        return isAbleTo('edit_process');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = request()->process->id;

        $rules = [
            'regulations' => ['nullable', 'array'],
            'regulations.*' => ['nullable', 'exists:media,id'],
            'usable_for_agency' => ['required', 'boolean'],
            'usable_for_dre' => ['required', 'boolean'],
            'is_active' => ['required', 'boolean'],
            'display_priority' => ['required', 'numeric'],
            'update_others_priority' => ['required', 'boolean'],
        ];
        $process = getProcesses(request('process')->id);
        if ($process->is_deletable) {
            $rules['family_id'] = ['required', 'exists:families,id'];
            $rules['domain_id'] = ['required', 'exists:domains,id'];
            $rules['name'] = ['required', 'string', 'max:255', 'unique:processes,name,' . $id . ',id'];
        }
        return $rules;
    }
}
