<?php

namespace App\Http\Requests\Mission\Detail;

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
        return isAbleTo('control_agency');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rows' => ['required', 'array'],
            'rows.*.detail' => ['required', 'exists:mission_details,id'],
            'rows.*.report' => ['required_if:rows.*.score,2,3,4'],
            'rows.*.recovery_plan' => ['required_if:rows.*.score,2,3,4'],
            'rows.*.major_fact' => ['required', 'boolean'],
            'rows.*.score' => ['required', 'in:1,2,3,4'],
            'rows.*.metadata' => ['sometimes', 'array'],
            'rows.*.media' => ['nullable', 'array'],
        ];
    }

    public function messages()
    {
        return [
            'rows.*.report.required_if' => 'Le champs :attribute est obligatoire.',
            'rows.*.recovery_plan.required_if' => 'Le champs :attribute est obligatoire.'
        ];
    }
}
