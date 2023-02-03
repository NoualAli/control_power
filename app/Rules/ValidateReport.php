<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateReport implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $attributes = explode('.', $attribute);
        $name = $attributes[0];
        $id = $attributes[1];
        $attribute = $name . '.' . $id . '.score';

        // dd(request()->$attribute, $attributes, !(request()->$attribute == 1));
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Le champs constat est obligatoire.';
    }
}