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
        $this->clearAll();
    }

    /**
     * Handle the Mission "updated" event.
     *
     * @param  \App\Models\Mission  $mission
     * @return void
     */
    public function updated(Mission $mission)
    {
        $this->clear($mission);
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

        $this->clear($mission);
        $this->clearAll();
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
        $this->clear($mission);
    }

    private function clearAll()
    {
        Cache::forget('missions');
    }

    private function clear(Mission $mission)
    {
        Cache::forget('mission-' . $mission->reference);
    }
}
