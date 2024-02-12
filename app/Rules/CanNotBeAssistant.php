<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CanNotBeAssistant implements Rule
{
    private $headOfMission;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($headOfMission)
    {
        $this->headOfMission = (int) $headOfMission;
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
        return $this->headOfMission !== $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return normalizeFullName(getUserFullNameWithRole($this->headOfMission)) . ' ne peut pas être chef de mission et assistant en même temps.';
    }
}