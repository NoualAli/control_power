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
            'first_name' => ['nullable', 'string', 'max:50'],
            'last_name' => ['nullable', 'string', 'max:50'],
            'phone' => ['nullable', new IsAlgerianPhoneNumber],
            'role' => ['required', 'exists:roles,id', new UniqueUserRole(request('agencies'), $id)],
            'is_active' => ['required', 'boolean'],
            'gender' => ['required', 'integer', 'in:1,2'],
            'registration_number' => ['required', 'numeric', 'unique:users,registration_number,' . $id . ',id', 'digits:4'],
        ];
        $role = request()->role;

        if (in_array($role, [13, 5])) {
            $rules['agencies'] = ['required', 'string'];
        }

        if ($role == 6) {
            $rules['agencies'] = ['required', 'array'];
        }

        if ($role == 11) {
            $rules['agencies'] = ['required', 'exists:agencies,id'];
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
