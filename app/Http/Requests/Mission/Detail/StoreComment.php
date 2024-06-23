<?php

namespace App\Http\Requests\Mission\Detail;

use App\Rules\MaxLengthQuill;
use Illuminate\Foundation\Http\FormRequest;

class StoreComment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = auth()->user();
        return (hasRole('cdc') && $this->mission->created_by_id == $user->id) ||  (hasRole('ci') && $this->mission->assigned_to_ci_id == $user->id);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'content' => ['required', new MaxLengthQuill(3000)]
        ];
    }
}
