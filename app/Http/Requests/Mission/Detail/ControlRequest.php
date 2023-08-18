<?php

namespace App\Http\Requests\Mission\Detail;

use Illuminate\Foundation\Http\FormRequest;

class ControlRequest extends FormRequest
{
    private $mode;

    public function __construct()
    {
        $this->mode = request()->currentMode;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // $details = auth()->user()->details()->pluck('id')->toArray();
        // dd(isAbleTo(['control_agency']), in_array($this->mode, [1, 2, 3, 4, 5]), in_array(request()->detail, $details));
        return in_array($this->mode, [1, 2, 3, 4, 5]) && (hasRole(['dcp', 'cdcr']) || isAbleTo(['control_agency']) || in_array(request()->detail, $details));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'currentMode' => ['required', 'in:1,2,3,4,5'],
            'detail' => ['required', 'exists:mission_details,id'],
            'report' => ['required_if:score,1,2,3,4', 'max:1000'],
            'recovery_plan' => ['required_if:score,2,3,4', 'max:1000'],
            'major_fact' => ['required', 'boolean'],
            'score' => ['required', 'in:1,2,3,4'],
            'metadata' => ['sometimes', 'array'],
            'media' => ['nullable', 'array'],
        ];

        if (in_array($this->mode, [3, 4, 5])) {
            unset($rules['report'], $rules['score'], $rules['metadata']);
            return $rules;
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'report.required_if' => 'Le champs :attribute est obligatoire.',
            'recovery_plan.required_if' => 'Le champs :attribute est obligatoire.'
        ];
    }
}