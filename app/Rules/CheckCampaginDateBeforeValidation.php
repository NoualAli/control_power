<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CheckCampaginDateBeforeValidation implements Rule
{
    private $startDate;
    private $totalNotValidatedCampaigns;
    private $notValidatedCampaigns;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->startDate = request()->start_date;
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
        if ($value && $this->startDate) {
            $this->notValidatedCampaigns = DB::table('control_campaigns as cc')
                ->whereDate('end_date', '<', $this->startDate)
                ->whereNull('deleted_at')
                ->whereNull('validated_at');

            $this->notValidatedCampaigns = $this->notValidatedCampaigns->orderBy('start_date')
                ->pluck('reference');

            $this->totalNotValidatedCampaigns = $this->notValidatedCampaigns->count();

            return !$this->notValidatedCampaigns->count();
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
        $responseMessage = 'Il est nécessaire de valider';
        $responseMessage .= $this->totalNotValidatedCampaigns > 1 ? ' les campagnes de contrôle ' : ' la campagne de contrôle ';
        $responseMessage .= $this->notValidatedCampaigns->join(', ') . ' avant de pouvoir valider cette campagne de contrôle.';
        return $responseMessage;
    }
}