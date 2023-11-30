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
        return [
            'name' => ['required', new UniqueInProcess(request()->process_id, $id), 'string', 'max:255'],
            'family_id' => ['required', 'exists:families,id'],
            'domain_id' => ['required', 'exists:domains,id'],
            'process_id' => ['required', 'exists:processes,id'],
            'has_major_fact' => ['required', 'boolean'],
            'sampling_fields' => ['nullable', 'exists:fields,id'],
            'scores' => ['nullable', 'array'],
            'scores.*' => ['required', 'array'],
            'scores.*.0.score' => ['required', 'distinct'],
            'scores.*.1.label' => ['required', 'distinct'],
        ];
    }
}
