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

        return [
            'family_id' => ['required', 'exists:families,id'],
            'domain_id' => ['required', 'exists:domains,id'],
            'name' => ['required', 'string', 'max:255', 'unique:processes,name,' . $id . ',id'],
            'regulations' => ['nullable', 'array'],
            'regulations.*' => ['nullable', 'exists:media,id']
        ];
    }
}
