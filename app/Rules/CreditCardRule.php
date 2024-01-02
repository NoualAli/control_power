<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CreditCardRule implements Rule
{
    protected $requiredDigits = 16;
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
        // Strip any non-digits (useful for credit card numbers with spaces and hyphens)
        $number = preg_replace('/\D/', '', $value);

        // Set the string length and parity
        $number_length = strlen($number);
        $parity = $number_length % 2;

        // Loop through each digit and do the maths
        $total = 0;
        for ($i = 0; $i < $number_length; $i++) {
            $digit = $number[$i];
            // Multiply alternate digits by two
            if ($i % 2 == $parity) {
                $digit *= 2;
                // If the sum is two digits, add them together (in effect)
                if ($digit > 9) {
                    $digit -= 9;
                }
            }
            // Total up the digits
            $total += $digit;
        }

        // If the total mod 10 equals 0, the number is valid
        return ($total % 10 == 0);
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
        return $sentenceBegining . ' n\'est pas un n° de carte valide.';
    }
}
