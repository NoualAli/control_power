<?php

namespace App\Http\Requests\Mission;

use App\Rules\CanBeControlled;
use App\Rules\IncludedInsideCDCDate;
use App\Rules\IsAbleTo;
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
        return isAbleTo('create_mission');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'agencies' => ['required', 'array', new CanBeControlled],
            'controllers' => ['required', 'array', new IsAbleTo('control_agency')],
            'start' => ['required', 'date', new IncludedInsideCDCDate(request()->control_campaign_id)],
            'end' => ['required', 'date', 'after:start', new IncludedInsideCDCDate(request()->control_campaign_id)],
            'control_campaign_id' => ['required', 'exists:control_campaigns,id'],
            'note' => ['nullable', 'string', 'max:1000'],
            'processMode' => ['nullable'],
        ];
    }
}
