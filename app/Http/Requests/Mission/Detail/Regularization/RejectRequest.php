<?php

namespace App\Http\Requests\Mission\Detail\Regularization;

use App\Rules\MaxLengthQuill;
use Illuminate\Foundation\Http\FormRequest;

class RejectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return isAbleTo('reject_regularization');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'regularization_id' => ['required', 'exists:mission_detail_regularizations,id'],
            'comment' => ['required', new MaxLengthQuill(1000)]
        ];
    }
}
