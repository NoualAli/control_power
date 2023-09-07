<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class MissionDontExceedFifteenDays implements Rule
{
    private $start;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(String $start)
    {
        $this->start = $start;
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
        return Carbon::parse($this->start)->diffInDays($value) <= 15;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Le champ :attribute ne doit pas dépasser 15 jours.';
    }
}