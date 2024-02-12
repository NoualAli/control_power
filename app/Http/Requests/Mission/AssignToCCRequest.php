<?php

namespace App\Http\Requests\Mission;

use Illuminate\Foundation\Http\FormRequest;

class AssignToCCRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return isAbleTo('assign_mission_processing');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (request()->mission->dcpController) {
            $controllersRequired = 'nullable';
        } else {
            $controllersRequired = 'required';
        }

        return [
            'controllers' => [$controllersRequired, 'array'],
            'controllers.*' => ['exists:users,id'],
        ];
    }
}
