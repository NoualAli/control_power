<?php

namespace App\Http\Requests\ControlCampaign;

use App\Rules\CheckCampaignDate;
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
        return isAbleTo('edit_control_campaign') && !boolval(intval(request()->campaign->is_validated));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => ['required', 'string', new MaxLengthQuill(3000)],
            'start_date' => ['required', 'date', new CheckCampaignDate(request('campaign'))],
            'end_date' => ['required', 'date', 'after:start', new CheckCampaignDate(request('campaign'))],
            'pcf' => ['required', 'array'],
        ];
    }
}
