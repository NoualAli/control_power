<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class IsAbleTo implements Rule
{
    private $user;
    private $ability;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($ability)
    {
        $this->ability = $ability;
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
        $user = User::findOrFail($value);
        return $user->isAbleTo($this->ability);
        // return hasRole('ci');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->user . " n'a pas les autorisations requises pour contrôler une agence";
    }
}