<?php

namespace App\Http\Requests\ControlCampaign;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

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
            'description' => ['required', 'string', 'max:500'],
            'start' => ['required', 'date'],
            'end' => ['required', 'date', 'after:start'],
            'pcf' => ['required', 'array'],
        ];
    }
}