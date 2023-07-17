<?php

namespace App\Http\Requests\Mission\Report;

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
        return isAbleTo(['create_ci_report', 'create_cdc_report']) && ($mission->dreControllers->contains('id', $currentUser) || $currentUser == request()->mission->created_by_id);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => ['required', 'string', 'max:3000'],
            'type' => ['required', 'in:ci_report,cdc_report'],
            'id' => ['nullable', 'exists:comments'],
            'validated' => ['required', 'boolean']
        ];
    }

    public function messages()
    {
        $type = request()->type;
        // dd($type);
        if ($type == 'ci_report') {
            return [
                'content.required' => 'Le champ compte-rendu est obligatoire.',
                'content.string' => 'Le champ compte-rendu doit être une chaine de caractaire.',
                'content.max' => 'Le champ compte-rendu ne doit pas dépasser 3000 caractaires.',
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
