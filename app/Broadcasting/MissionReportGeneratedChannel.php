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
        // return true;
        return hasRole(['cdcr', 'dcp', 'dg', 'sg', 'cdrcp', 'ig']) || in_array($mission->id, $user->missions()->pluck('id')->toArray());
    }
}
