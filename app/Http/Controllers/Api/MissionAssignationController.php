<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\AssignMissionProcessesRequest;
use App\Models\Mission;
use App\Models\User;

class MissionAssignationController extends Controller
{
    /**
     * Fetch pcf and controllers lists
     *
     * @param Mission $mission
     * @param string $type
     *
     * @return array
     */
    public function loadAssignationData(Mission $mission, string $type)
    {
        if (in_array($type, ['ci', 'cc'])) {
            $pcfList = $mission->notDispatchedProcesses($type);
            $controllersList = formatForSelect(User::whereRoles([$type])->doesntHave('details')->get()->toArray(), 'full_name');
        } else {
            abort(500, "Le type $type est un type inconnu");
        }
        return  compact('pcfList', 'controllersList');
    }

    /**
     * Assign processes to controllers
     *
     * @param AssignMissionProcessesRequest $request
     * @param Mission $mission
     *
     * @return JsonRespone
     */
    public function assign(AssignMissionProcessesRequest $request, Mission $mission, string $type)
    {
        $processes = pcfToProcesses($request->pcf);
        // dd($mission->details->pluck('process'));
        $details = $mission->details()->whereRelation('process', fn ($query) => $query->whereIn('processes.id', $processes));
        // ->whereRelation('controlPoint', function ($query) use ($processes) {
        //     dd($query->get());
        //     return $query->whereIn('process_id', $processes);
        // });
        dd($details->get());
    }
}
