<?php

namespace App\Http\Requests\Mission\Detail\Regularization;

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
        // dd(request()->all());
        return isAbleTo('regularize_mission_detail');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'mission_detail_id' => ['required', 'exists:mission_details,id'],
            'is_regularized' => ['required', 'boolean'],
            'action_to_be_taken' => ['required', 'max:1000'],
            'media' => ['nullable', 'array'],
            'media.*' => ['exists:media,id']
        ];
    }
}
