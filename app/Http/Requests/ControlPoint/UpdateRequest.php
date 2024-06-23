<?php

namespace App\Http\Requests\ControlPoint;

use App\Rules\UniqueInProcess;
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
        return isAbleTo('edit_control_point');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = request()->controlPoint->id;
        $rules = [
            'has_major_fact' => ['required', 'boolean'],
            'usable_for_agency' => ['required', 'boolean'],
            'usable_for_dre' => ['required', 'boolean'],
            'is_active' => ['required', 'boolean'],
            'display_priority' => ['required', 'numeric'],
            'update_others_priority' => ['required', 'boolean'],
        ];

        $controlPoint = getControlPoints(request('controlPoint')->id);
        if ($controlPoint->is_deletable) {
            $rules['name'] = ['required', new UniqueInProcess(request()->process_id, $id), 'string', 'max:255'];
            $rules['family_id'] = ['required', 'exists:families,id'];
            $rules['domain_id'] = ['required', 'exists:domains,id'];
            $rules['process_id'] = ['required', 'exists:processes,id'];
            $rules['sampling_fields'] = ['nullable', 'exists:fields,id'];
            $rules['scores'] = ['nullable', 'array'];
            $rules['scores.*'] = ['required', 'array'];
            $rules['scores.*.0.score'] = ['required', 'distinct'];
            $rules['scores.*.1.label'] = ['required', 'distinct'];
        }
        return $rules;
    }
}
