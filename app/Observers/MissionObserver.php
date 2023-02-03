<?php

namespace App\Observers;

use App\Models\Mission;

class MissionObserver
{
    /**
     * Handle the Mission "created" event.
     *
     * @param  \App\Models\Mission  $mission
     * @return void
     */
    public function created(Mission $mission)
    {
        //
    }

    /**
     * Handle the Mission "updated" event.
     *
     * @param  \App\Models\Mission  $mission
     * @return void
     */
    public function updated(Mission $mission)
    {
        //
    }

    /**
     * Handle the Mission "deleted" event.
     *
     * @param  \App\Models\Mission  $mission
     * @return void
     */
    public function deleted(Mission $mission)
    {
        foreach ($mission->details as $detail) {
            $detail->delete();
        }
    }

    /**
     * Handle the Mission "restored" event.
     *
     * @param  \App\Models\Mission  $mission
     * @return void
     */
    public function restored(Mission $mission)
    {
        foreach ($mission->details as $detail) {
            $detail->update(['deleted_at' => null]);
        }
    }

    /**
     * Handle the Mission "force deleted" event.
     *
     * @param  \App\Models\Mission  $mission
     * @return void
     */
    public function forceDeleted(Mission $mission)
    {
        //
    }
}