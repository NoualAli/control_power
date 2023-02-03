<?php

namespace App\Http\Requests\ControlCampaign;

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
        return isAbleTo('edit_control_campaign') && request()->campaign->remaining_days_before_start > 5;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = request()->campaign->id;
        return [
            'reference' => ['required', 'unique:control_campaigns,reference,' . $id . ',id'],
            'description' => ['required', 'string', 'max:500'],
            'start' => ['required', 'date'],
            'end' => ['required', 'date', 'after:start'],
            'pcf' => ['required', 'array'],
        ];
    }
}