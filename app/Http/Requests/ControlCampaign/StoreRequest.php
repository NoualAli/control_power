<?php

namespace App\Http\Requests\ControlCampaign;

use App\Rules\CheckCampaignDate;
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
            'description' => ['required', 'string', 'max:3000'],
            'start' => ['required', 'date', new CheckCampaignDate],
            'end' => ['required', 'date', 'after:start', new CheckCampaignDate],
            'pcf' => ['required', 'array'],
            'validate' => ['required', 'boolean'],
        ];
    }
}
