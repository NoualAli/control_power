<?php

namespace App\Http\Requests\User;

use App\Rules\IsAlgerianPhoneNumber;
use App\Rules\UniqueUserRole;
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
        return isAbleTo('create_user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'username' => ['required', 'string', 'max:30', 'unique:users'],
            'email' => ['required', 'email:filter', 'unique:users', 'max:100'],
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'phone' => ['nullable', new IsAlgerianPhoneNumber],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'role' => ['required', 'exists:roles,id', new UniqueUserRole(request('agencies'))],
            'is_active' => ['required', 'boolean'],
            'gender' => ['required', 'integer', 'in:1,2'],
            'registration_number' => ['nullable', 'unique:users', 'numeric', 'max_digits:5'],
            'is_for_testing' => ['required', 'boolean'],
        ];
        $role = request()->role;

        if (in_array($role, [13, 5])) {
            $rules['structures'] = ['required', 'string'];
        }

        if ($role == 6) {
            $rules['structures'] = ['required', 'array'];
        }

        if ($role == 11) {
            $rules['structures'] = ['required', 'exists:agencies,id'];
        }

        if ($role == 19) {
            $rules['structures'] = ['required', 'exists:regional_inspections,id'];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'gender.in' => 'Le champ :attribute doit être Homme ou Femme'
        ];
    }
}