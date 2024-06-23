<?php

namespace App\Observers;

use App\Models\ControlCampaign;
use Illuminate\Support\Facades\Artisan;

class CampaignObserver
{
    /**
     * Handle the ControlCampaign "created" event.
     *
     * @param  \App\Models\ControlCampaign  $controlCampaign
     * @return void
     */
    public function created(ControlCampaign $controlCampaign)
    {
        // Artisan::call('campaign:notify', ['id' => $controlCampaign->id, 'created' => true]);
    }

    /**
     * Handle the ControlCampaign "updated" event.
     *
     * @param  \App\Models\ControlCampaign  $controlCampaign
     * @return void
     */
    public function updated(ControlCampaign $controlCampaign)
    {
        // Artisan::call('campaign:notify', ['id' => $controlCampaign->id, 'created' => false]);
    }

    /**
     * Handle the ControlCampaign "deleted" event.
     *
     * @param  \App\Models\ControlCampaign  $controlCampaign
     * @return void
     */
    public function deleted(ControlCampaign $controlCampaign)
    {
        foreach ($controlCampaign->missions as $mission) {
            $mission->delete();
            foreach ($mission->details as $detail) {
                $detail->delete();
            }
        }
    }

    /**
     * Handle the ControlCampaign "restored" event.
     *
     * @param  \App\Models\ControlCampaign  $controlCampaign
     * @return void
     */
    public function restored(ControlCampaign $controlCampaign)
    {
    }

    /**
     * Handle the ControlCampaign "force deleted" event.
     *
     * @param  \App\Models\ControlCampaign  $controlCampaign
     * @return void
     */
    public function forceDeleted(ControlCampaign $controlCampaign)
    {
        //
    }
}
