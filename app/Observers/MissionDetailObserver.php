<?php

namespace App\Observers;

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

        $today = now();
        $start = $mission->programmed_start;
        $end = $mission->programmed_end;
        $progressStatus = intval($mission->progress_status);
        $startDiff = $today->diffInDays($start, false);
        $endDiff = $today->diffInDays($end, false);
        $totalControlled = $mission->details()->controlled()->count();

        if ($startDiff >= 0 && $progressStatus == 0 && !$totalControlled) {
            $state = 1;
        } elseif (($progressStatus && $totalControlled) || ($startDiff <= 0 && $endDiff >= 0 && $progressStatus < 100 && $totalControlled)) {
            $state = 2;
        } elseif ($mission->ci_report_exists && !$mission->is_validated_by_ci) {
            $state = 3;
        } elseif ($mission->is_validated_by_ci && !$mission->is_validated_by_cdc) {
            $state = 4;
        } elseif ($mission->is_validated_by_cdc && !$mission->is_validated_by_cdcr) {
            $state = 5;
        } elseif ($mission->is_validated_by_cdcr && !$mission->is_validated_by_dcp) {
            $state = 6;
        } elseif ($mission->is_validated_by_dcp) {
            $state = 7;
        } elseif ($totalControlled && $endDiff > 0 && (!$mission->is_validated_by_ci || !$mission->is_validated_by_cdc || !$mission->is_validated_by_cdcr || !$mission->is_validated_by_dcp)) {
            $state = 8;
        } else {
            $state = 9;
        }
        $mission->update(['current_state' => $state]);
    }
}
