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
        return isAbleTo('regularize_mission_detail');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $isActionToBeTaken = request()->type == 'Action à engagé' && !request()->id && request()->reason == null;
        $isReason = request()->type == 'Cause' && !request()->id && request()->action_to_be_taken == null;
        // dd(request()->all());
        return [
            'detail_id' => ['required', 'exists:mission_details,id'],
            'id' => ['nullable', 'exists:regularizations,id'],
            'regularized' => ['required', 'boolean'],
            // 'type' => ['required_if:regularized,false', 'in:Cause,Action à engagé'],
            'reason' => [new RequiredIf(fn () => $isReason), 'max:1000'],
            'action_to_be_taken' => [new RequiredIf(fn () => $isActionToBeTaken), 'max:3000'],
            'committed_action' => ['required_if:regularized_at,true', 'string', 'max:3000'],
        ];
    }
}
