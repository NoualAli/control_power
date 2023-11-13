<?php

namespace App\Http\Requests\Mission\Detail;

use App\Rules\MaxLengthQuill;
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
        $userDetails = auth()->user()?->details()?->pluck('mission_details.id')->toArray() ?: [];
        return in_array($this->mode, [1, 2, 3, 4, 5]) && (hasRole(['dcp', 'cdcr']) || isAbleTo(['control_agency']) || in_array(request()->detail, $userDetails));
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
            'report' => ['required_if:score,1,2,3,4', new MaxLengthQuill(1000)],
            'recovery_plan' => ['required_if:score,2,3,4', new MaxLengthQuill(1000)],
            'major_fact' => ['required', 'boolean'],
            'score' => ['required', 'in:1,2,3,4'],
            'metadata' => ['sometimes', 'array'],
            'media' => ['nullable', 'array'],
        ];

        if (in_array($this->mode, [3, 4, 5])) {
            unset($rules['report'], $rules['score'], $rules['metadata']);
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
