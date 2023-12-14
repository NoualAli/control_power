<?php

namespace App\Http\Requests\ControlCampaign;

use App\Rules\MaxLengthQuill;
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
        return isAbleTo('edit_control_campaign') && (request()->campaign->remaining_days_before_start > 5 || !request()->campaign->validated_by_id);
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
            'description' => ['required', 'string', new MaxLengthQuill(3000)],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start'],
            'pcf' => ['required', 'array'],
            'is_for_testing' => ['required', 'boolean'],
        ];
    }
}
