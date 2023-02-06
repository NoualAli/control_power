<?php

namespace App\Http\Requests\Mission\Report;

use Illuminate\Foundation\Http\FormRequest;

class ValidateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $report = null;
        switch (request()->type) {
            case 'Avis contrôleur':
                $report = request()->mission->controller_opinion;
                break;
            default:
                $report = request()->mission->head_of_department_report;
                break;
        }
        return isAbleTo(['validate_opinion', 'validate_report']) && $report->created_by_id == auth()->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $types = implode(',', REPORT_TYPES);
        return [
            'type' => ['required', 'in:' . $types]
        ];
    }
}