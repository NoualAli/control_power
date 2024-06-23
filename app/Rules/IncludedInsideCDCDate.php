<?php

namespace App\Rules;

use App\Models\ControlCampaign;
use App\Models\DREControlCampaign;
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
    public function __construct(?string $campaign = null, int $type = 1)
    {
        if ($campaign) {
            if ($type == 2) {
                $this->campaign = DREControlCampaign::findOrFail($campaign);
            } else {
                $this->campaign = ControlCampaign::findOrFail($campaign);
            }
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
        if ($this->campaign) {
            $startDate = Carbon::parse($this->campaign->start_date);
            $endDate = Carbon::parse($this->campaign->end_date);
            $date = Carbon::parse($value);
            return $date->between($startDate, $endDate);
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
        return 'Le champs :attribute doit être une date incluse entre le ' . Carbon::parse($this->campaign->start_date)->format('d-m-Y') . ' et le ' . Carbon::parse($this->campaign->end_date)->format('d-m-Y');
    }
}
