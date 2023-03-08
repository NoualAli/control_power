<?php

namespace App\Http\Requests\Mission;

use App\Rules\CanBeControlled;
use App\Rules\IncludedInsideCDCDate;
use App\Rules\IsAbleTo;
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
        $mission = request()->mission;
        return isAbleTo('edit_mission') && $mission->remaining_days_before_start > 5;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'controllers' => ['required', 'array', new IsAbleTo('control_agency')],
            'start' => ['required', 'date', new IncludedInsideCDCDate(request()->control_campaign_id)],
            'end' => ['required', 'date', 'after:start', new IncludedInsideCDCDate(request()->control_campaign_id)],
            'note' => ['nullable', 'string', 'max:255']
        ];
    }
}
