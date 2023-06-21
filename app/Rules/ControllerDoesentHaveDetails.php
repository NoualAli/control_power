<?php

namespace App\Rules;

use App\Models\Mission;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class ControllerDoesentHaveDetails implements Rule
{
    /**
     * @var App\Models\Mission
     */
    private $mission;

    /**
     * @var App\Models\User
     */
    private $controller;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Mission $mission)
    {
        $this->mission = $mission;
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
        $this->controller = User::findOrFail($value);
        $details = $this->controller->details()?->where('mission_id', $this->mission->id)->count();
        return !$details;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Le contrôleur ' . $this->controller->full_name . ' à déjà des processus assignés à lui dans la mission ' . $this->mission->reference;
    }
}
