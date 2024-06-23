<?php

namespace App\Http\Requests\Mission;

use App\Enums\MissionState;
use App\Rules\CanBeControlled;
use App\Rules\CanNotBeAssistant;
use App\Rules\CanNotBetAssistant;
use App\Rules\CheckIfControllerHasMissionInDateRange;
use App\Rules\IncludedInsideCDCDate;
use App\Rules\IsAbleTo;
use App\Rules\MaxLengthQuill;
use App\Rules\MissionDontExceedFifteenDays;
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
        // dd((int) $mission->current_state !== MissionState::TODO);
        return isAbleTo('edit_mission') && (int) $mission->current_state == MissionState::TODO && in_array($mission->agency_id, auth()->user()->agencies->pluck('id')->toArray());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'control_campaign_id' => ['required', 'exists:control_campaigns,id'],
            'head_of_mission_id' => ['required', 'exists:users,id', new IsAbleTo('control_agency'), new CheckIfControllerHasMissionInDateRange(request('mission'))],
            'assistants' => ['nullable', 'array', 'max:2'],
            'assistants.*' => ['exists:users,id', new IsAbleTo('control_agency'), new CheckIfControllerHasMissionInDateRange(request('mission')),  new CanNotBeAssistant(request('head_of_mission_id'))],
            'agency_id' => ['required', 'exists:agencies,id', new CanBeControlled],
            'programmed_start' => ['required', 'date', new IncludedInsideCDCDate(request()->control_campaign_id)],
            'programmed_end' => ['required', 'date', 'after:programmed_start', new IncludedInsideCDCDate(request()->control_campaign_id), new MissionDontExceedFifteenDays(request()->programmed_start)],
            'note' => ['nullable', 'string', new MaxLengthQuill(1000)],
        ];
    }

    public function messages()
    {
        return [
            'assistants.max' => 'Une mission ne peut contenir plus de deux contrôleurs à la fois'
        ];
    }
}
