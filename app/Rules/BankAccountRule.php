<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BankAccountRule implements Rule
{
    protected $label;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(?string $label = null)
    {
        $this->label = $label;
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
        return preg_match('/^[0-9]{9,20}$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $sentenceBegining = 'Le champs :attribute';
        if ($this->label) {
            $sentenceBegining = 'Le champs ' . $this->label;
        }
        return $sentenceBegining . ' n\'est pas un n° compte valide.';
    }
}
