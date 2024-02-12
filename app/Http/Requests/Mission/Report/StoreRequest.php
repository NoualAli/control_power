<?php

namespace App\Http\Requests\Mission\Report;

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
        $currentUser = auth()->user()->id;
        $mission = request()->mission;
        // dd($currentUser, $mission->dreController->id, $mission->created_by_id);
        return isAbleTo(['create_ci_report', 'create_cdc_report']) && ($mission->dreController?->id == $currentUser || $currentUser == $mission->created_by_id);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'content' => ['required', 'string', new MaxLengthQuill(3000)],
            'type' => ['required', 'in:ci_report,cdc_report'],
            'id' => ['nullable', 'exists:comments'],
            'validated' => ['required', 'boolean']
        ];
        if (hasRole('ci')) {
            $rules['mission_order'] = ['required', 'array'];
            $rules['mission_order.*'] = ['exists:media,id'];
        }

        if (hasRole('cdc')) {
            $rules['closing_report'] = ['required', 'array'];
            $rules['closing_report.*'] = ['exists:media,id'];
        }
        return $rules;
    }

    public function messages()
    {
        $type = request()->type;
        if ($type == 'ci_report') {
            return [
                'content.required' => 'Le champ conclusion est obligatoire.',
                'content.string' => 'Le champ conclusion doit être une chaine de caractaire.',
                'content.max' => 'Le champ conclusion ne doit pas dépasser 3000 caractaires.',
            ];
        } elseif ($type == 'cdc_report') {
            return [
                'content.required' => 'Le champ rapport est obligatoire.',
                'content.string' => 'Le champ rapport doit être une chaine de caractaire.',
                'content.max' => 'Le champ rapport ne doit pas dépasser 3000 caractaires.',
            ];
        } else {
            abort(500, "Le type $type est un type inconnu.");
        }
    }
}