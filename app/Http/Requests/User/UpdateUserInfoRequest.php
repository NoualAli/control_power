<?php

namespace App\Http\Requests\User;

use App\Rules\IsAlgerianPhoneNumber;
use App\Rules\UniqueUserRole;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return isAbleTo('edit_user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = request()->user->id;
        $rules = [
            'username' => ['required', 'string', 'max:30', 'unique:users,username,' . $id . ',id'],
            'email' => ['required', 'email:filter', 'unique:users,email,' . $id . ',id', 'max:100'],
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'phone' => ['nullable', new IsAlgerianPhoneNumber],
            'role' => ['required', 'exists:roles,id', new UniqueUserRole(request('structures'), $id)],
            'is_active' => ['required', 'boolean'],
            'gender' => ['required', 'integer', 'in:1,2'],
            'registration_number' => ['nullable', 'numeric', 'unique:users,registration_number,' . $id . ',id', 'max_digits:5'],
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