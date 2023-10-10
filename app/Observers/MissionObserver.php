<?php

namespace App\Observers;

use App\Models\Mission;
use Illuminate\Support\Facades\Cache;

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
        // $this->clearAll();
    }

    /**
     * Handle the Mission "updated" event.
     *
     * @param  \App\Models\Mission  $mission
     * @return void
     */
    public function updated(Mission $mission)
    {
        // 1 todo
        // 2 active
        // 3 waiting for ci validation
        // 4 waiting for cdc validation
        // 5 waiting for cdcr validation
        // 6 waiting for cc validation
        // 7 waiting for dcp validation
        // 8 done
        // 9 delay
        // 10 undefined

        // $today = now();
        // $start = $mission->programmed_start;
        // $end = $mission->programmed_end;
        // $progressStatus = intval($mission->progress_status);
        // $startDiff = $today->diffInDays($start, false);
        // $endDiff = $today->diffInDays($end, false);
        // $totalControlled = $mission->details()->controlled()->count();

        // if ($startDiff >= 0 && $progressStatus == 0 && !$totalControlled) {
        //     $state = 1;
        // } else if ($startDiff < 0 && $progressStatus == 0 && !$totalControlled) {
        //     $state = 9;
        // } else if ($startDiff <= 0 && $endDiff >= 0 && $progressStatus < 100 && $totalControlled) {
        //     $state = 2;
        // } else if ($progressStatus >= 100 && ($mission->ci_report_exists && $mission->is_validated_by_ci && (!$mission->cdc_report_exists || ($mission->cdc_report_exists && !$mission->is_validated_by_cdc)) || !$mission->ci_report_exists)) {
        //     $state = 3;
        // } else if ($progressStatus >= 100 && $mission->is_validated_by_cdc && !$mission->is_validated_by_cdcr) {
        //     $state = 4;
        // } else if ($progressStatus >= 100 && $mission->is_validated_by_cdc && $mission->is_validated_by_cdcr && !$mission->is_validated_by_dcp) {
        //     $state = 5;
        // } else if ($progressStatus >= 100 && $mission->is_validated_by_cdc && $mission->is_validated_by_dcp) {
        //     $state = 6;
        // } else if ($endDiff < 0 && $progressStatus < 100 && (!$mission->is_validated_by_ci || !$mission->is_validated_by_cdc)) {
        //     $state = 9;
        // } elseif ($progressStatus && $totalControlled) {
        //     return 2;
        // } else {
        //     $state = 10;
        // }
        // $mission->update(['active_state' => $state]);
    }

    /**
     * Handle the Mission "deleted" event.
     *
     * @param  \App\Models\Mission  $mission
     * @return void
     */
    public function deleted(Mission $mission)
    {
        // foreach ($mission->details as $detail) {
        //     $detail->delete();
        // }

        // $this->clear($mission);
        // $this->clearAll();
    }

    /**
     * Handle the Mission "restored" event.
     *
     * @param  \App\Models\Mission  $mission
     * @return void
     */
    public function restored(Mission $mission)
    {
        // foreach ($mission->details as $detail) {
        //     $detail->update(['deleted_at' => null]);
        // }
    }

    /**
     * Handle the Mission "force deleted" event.
     *
     * @param  \App\Models\Mission  $mission
     * @return void
     */
    public function forceDeleted(Mission $mission)
    {
        // $this->clear($mission);
    }

    private function clearAll()
    {
        // Cache::forget('missions');
    }

    private function clear(Mission $mission)
    {
        // Cache::forget('mission-' . $mission->reference);
    }
}