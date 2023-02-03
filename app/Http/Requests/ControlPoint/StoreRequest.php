<?php

namespace App\Http\Requests\ControlPoint;

use App\Rules\UniqueInProcess;
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
        return isAbleTo('create_control_point');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', new UniqueInProcess(request()->process_id), 'string', 'max:255'],
            'familly_id' => ['required', 'exists:famillies,id'],
            'domain_id' => ['required', 'exists:domains,id'],
            'process_id' => ['required', 'exists:processes,id'],
            'scores' => ['nullable', 'array'],
            'scores.*' => ['required', 'array'],
            'scores.*.0.score' => ['required', 'distinct'],
            'scores.*.1.label' => ['required', 'distinct'],
            'fields' => ['nullable', 'array'],
            'fields.*' => ['required', 'array'],
            'fields.*.0.type' => ['required', 'in:text,textarea,number,select,date,datetime,month,week,time,email,tel'],
            'fields.*.1.label' => ['nullable', 'distinct', 'max:255'],
            'fields.*.2.name' => ['required', 'distinct', 'max:50'],
            'fields.*.3.length' => ['required', 'numeric', 'digits_between:1,4'],
            'fields.*.4.style' => ['required', 'string', 'max:255'],
            'fields.*.5.id' => ['nullable', 'distinct', 'max:255'],
            'fields.*.6.placeholder' => ['nullable', 'distinct', 'max:255'],
            'fields.*.7.help_text' => ['nullable', 'distinct', 'max:255'],
            'fields.*.8.rules' => ['required', 'max:255'],
        ];
    }
}