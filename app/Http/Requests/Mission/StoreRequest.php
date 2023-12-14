<?php

namespace App\Http\Requests\Mission;

use App\Rules\CanBeControlled;
use App\Rules\IncludedInsideCDCDate;
use App\Rules\IsAbleTo;
use App\Rules\MaxLengthQuill;
use App\Rules\MissionDontExceedFifteenDays;
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
            'agency' => ['required', 'exists:agencies,id', new CanBeControlled],
            'controllers' => ['required', 'array', new IsAbleTo('control_agency')],
            'programmed_start' => ['required', 'date', new IncludedInsideCDCDate(request()->control_campaign_id)],
            'programmed_end' => ['required', 'date', 'after:programmed_start', new IncludedInsideCDCDate(request()->control_campaign_id), new MissionDontExceedFifteenDays(request()->programmed_start)],
            'control_campaign_id' => ['required', 'exists:control_campaigns,id'],
            'note' => ['nullable', 'string', new MaxLengthQuill(1000)],
            'is_for_testing' => ['required', 'boolean'],
        ];
    }
}
