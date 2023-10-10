<?php

namespace App\Rules;

use App\Models\ControlCampaign;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class CheckCampaignDate implements Rule
{
    /**
     * @var Carbon
     */
    private $endDate;

    /**
     * @var App\Models\ControlCampaign
     */
    private $lastCampaign;

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
        $this->lastCampaign = ControlCampaign::whereYear('start_date', Carbon::parse(request()->start_date)->format('Y'))->orderBy('start_date', 'ASC')->first();
        if ($this->lastCampaign instanceof ControlCampaign) {
            $this->endDate = Carbon::parse($this->lastCampaign?->end_date);
            return Carbon::parse($this->endDate)->diffInDays($value, false) > 0;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Le champ :attribute doit être supèrieur à la date de fin de la dernière campagne ' . $this->lastCampaign->reference . ' donc supèrieur à ' . $this->endDate->format('d-m-Y') . ' .';
    }
}
