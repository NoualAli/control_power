<?php

namespace App\Rules;

use App\Models\ControlCampaign;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class IncludedInsideCDCDate implements Rule
{
    /**
     * @var App\Models\ControlCampaign
     */
    private $campaign;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $campaign)
    {
        $this->campaign = ControlCampaign::findOrFail($campaign);
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
        $startDate = Carbon::parse($this->campaign->start);
        $endDate = Carbon::parse($this->campaign->end);
        $date = Carbon::parse($value);
        return $date->between($startDate, $endDate);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Le champs :attribute doit être une date incluse entre le ' . $this->campaign->start . ' et le ' . $this->campaign->end;
    }
}
