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
        if (!request('is_for_testing')) {
            $greatterOrEquelThanToday = Carbon::parse($value)->diffInDays(today(), false) <= 0;
            // Fetch all campaigns that are'nt for testing and are validated
            $this->lastCampaign = ControlCampaign::isNotForTesting()->validated()->whereYear('start_date', Carbon::parse(request()->start_date)->format('Y'))->orderBy('start_date', 'ASC')->first();
            // If we get results we can process to check
            if ($this->lastCampaign instanceof ControlCampaign) {
                $this->endDate = Carbon::parse($this->lastCampaign?->end_date);
                // Check if value is greatter than last campaign end date and greatter than today date
                return Carbon::parse($this->endDate)->diffInDays($value, false) > 0 && $greatterOrEquelThanToday;
            }
            // By default we check if date is greatter or equal to today date
            return $greatterOrEquelThanToday;
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
        if ($this->lastCampaign instanceof ControlCampaign) {
            return 'Le champ :attribute doit être supèrieur à la date de fin de la dernière campagne ' . $this->lastCampaign->reference . ' donc supèrieur à ' . $this->endDate->format('d-m-Y') . ' .';
        } else {
            return 'Le champ :attribute doit être supèrieur à la date d\'aujourd\'hui donc supèrieur à ' . today()->format('d-m-Y') . ' .';
        }
    }
}
