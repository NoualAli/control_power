<?php

namespace App\Rules;

use App\Models\DREMission;
use Illuminate\Contracts\Validation\Rule;

class DreMissionExist implements Rule
{
    private $campaign;
    private $mission;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $campaign, ?string $mission = null)
    {
        $this->campaign = $campaign;
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
        $mission = DREMission::where('controlled_dre_id', $value)->where('dre_control_campaign_id', $this->campaign);
        if ($this->mission) {
            $mission = $mission->where('id', '!=', $this->mission);
        }
        return !$mission->first()?->count();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Une mission avec la même référence exite déjà !';
    }
}
