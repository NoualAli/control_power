<?php

namespace App\Broadcasting;

use App\Models\Mission;
use App\Models\User;

class MissionReportGeneratedChannel
{
    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\User  $user
     * @return array|bool
     */
    public function join(User $user, Mission $mission)
    {
        $missions = $user->missions()->where('campagin_id', '!=', 1)?->pluck('id')->toArray() ?: [];
        return hasRole(['cdcr', 'dcp', 'cdrcp']) || in_array($mission->id, $missions);
    }
    // public function join(User $user)
    // {
    //     // $missions = $user->missions()?->pluck('id')->toArray() ?: [];
    //     return auth()->check() && auth()->user()->id == $user->id;
    // }
}
