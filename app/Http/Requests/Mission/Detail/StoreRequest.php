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
        $processMode = request()->process_mode;
        $isAbleTo = !$processMode ? 'control_agency' : 'process_mission';
        return isAbleTo($isAbleTo) || hasRole(['dcp', 'cdcr', 'cc']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (request()->has('detail')) {
            // if detail id is provided
            if (request()->process_mode) {
                // if process mode is true
                return [
                    'process_mode' => ['required', 'boolean'],
                    'detail' => ['required', 'exists:mission_details,id'],
                    'score' => ['required', 'in:1,2,3,4'],
                    'major_fact' => ['required', 'boolean'],
                ];
            }
            // else we accept updating all data
            return [
                'process_mode' => ['required', 'boolean'],
                'detail' => ['required', 'exists:mission_details,id'],
                'report' => ['required_if:rows.*.score,2,3,4'],
                'recovery_plan' => ['required_if:rows.*.score,2,3,4'],
                'major_fact' => ['required', 'boolean'],
                'score' => ['required', 'in:1,2,3,4'],
                'metadata' => ['sometimes', 'array'],
                'media' => ['nullable', 'array'],
            ];
        } else {
            // If detail id is not provided
            return [
                'process_mode' => ['required', 'boolean'],
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
    }

    public function messages()
    {
        return [
            'rows.*.report.required_if' => 'Le champs :attribute est obligatoire.',
            'rows.*.recovery_plan.required_if' => 'Le champs :attribute est obligatoire.'
        ];
    }
}
