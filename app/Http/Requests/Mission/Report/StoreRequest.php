<?php

namespace App\Http\Requests\Mission\Report;

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
        $currentUser = auth()->user()->id;
        return isAbleTo(['create_opinion', 'create_report']) && (in_array($currentUser, request()->mission->controllers->pluck('id')->toArray()) || $currentUser == request()->mission->created_by_id);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $types = implode(',', REPORT_TYPES);
        $type = request()->type;
        if ($type == 'opinion') {
            return [
                'opinion' => ['required', 'string', 'max:1000'],
                'type' => ['required', 'in:Avis du contrôleur'],
                'id' => ['nullable', 'exists:mission_reports'],
                'validated' => ['required', 'boolean']
            ];
        } else {
            return [
                'report' => ['required', 'string', 'max:2000'],
                'type' => ['required', 'in:Rapport'],
                'id' => ['nullable', 'exists:mission_reports'],
                'validated' => ['required', 'boolean']
            ];
        }
    }
}
