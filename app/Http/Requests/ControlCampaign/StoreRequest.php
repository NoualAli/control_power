<?php

namespace App\Http\Requests\ControlCampaign;

use App\Rules\CheckCampaignDate;
use App\Rules\MaxLengthQuill;
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
        return isAbleTo('create_control_campaign');
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
            'start_date' => ['required', 'date', new CheckCampaignDate],
            'end_date' => ['required', 'date', 'after:start', new CheckCampaignDate],
            'pcf' => ['required', 'array'],
            'is_validated' => ['required', 'boolean'],
            'is_for_testing' => ['required', 'boolean'],
        ];
    }
}
