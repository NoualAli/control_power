<?php

namespace App\Observers;

use App\Enums\MissionState;
use App\Models\MissionDetail;

class MissionDetailObserver
{
    /**
     * Handle the Mission "updated" event.
     *
     * @param  \App\Models\Mission  $mission
     * @return void
     */
    public function updated(MissionDetail $missionDetail)
    {
        $mission = $missionDetail->mission;
        $totalControlled = $mission->details()->controlled()->count();

        if ($mission->current_state == MissionState::TODO && hasRole('ci') && $totalControlled > 0 && $totalControlled <= 1) {
            $mission->update(['current_state' => MissionState::ACTIVE]);
        }
    }
}
