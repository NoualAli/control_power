<?php

namespace App\Rules;

use App\Models\ControlPoint;
use App\Models\Process;
use Illuminate\Contracts\Validation\Rule;

class UniqueInProcess implements Rule
{
    /**
     * @var App\Models\Process
     */
    private $process;

    /**
     * @var App\Models\ControlPoint|null
     */
    private $controlPoint;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(?int $process, ?int $controlPoint = null)
    {
        if ($process) {
            $this->process = Process::findOrFail($process);
            $this->controlPoint = $controlPoint ? ControlPoint::find($controlPoint) : null;
        } else {
            return false;
        }
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

        if (!$this->controlPoint?->id) {
            return $this->process->control_points()->where($attribute, $value)->count() < 1;
        } else {
            return $this->process->control_points()->where($attribute, $value)->count() < 2;
        }


        // dd($attribute, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Le champs :attribute est déjà utilisé dans le même processus.';
    }
}
