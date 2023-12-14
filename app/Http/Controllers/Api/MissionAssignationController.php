<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\AssignMissionProcessesRequest;
use App\Models\Family;
use App\Models\Mission;
use App\Models\Process;
use App\Models\User;
use App\Notifications\Mission\Detail\MissionDetailAssigned;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

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
        hasRoleOrAbort('cdcr');
        if (in_array($type, ['ci', 'cc'])) {
            $pcfList = $mission->notDispatchedProcesses($type);

            $controllersList = User::whereRoles(['cc'])->get();

            $userIds = $controllersList->pluck('id')->toArray();

            $controllersList = formatForSelect($controllersList->filter(fn ($controller) => !$controller->total_mission_details)->toArray(), 'full_name');
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
        try {
            $result = DB::transaction(function () use ($request, $mission, $type) {
                $processes = pcfToProcesses($request->pcf);
                $controller = $request->controller;
                $details = $mission->details()->whereRelation('process', fn ($query) => $query->whereIn('processes.id', $processes))->get();
                if ($type == 'cc') {
                    $controllerDbColumn = 'assigned_to_cc_id';
                } elseif ($type == 'ci') {
                    $controllerDbColumn = 'assigned_to_ci_id';
                } else {
                    abort(500, "Le type $type est un type inconnu.");
                }
                foreach ($details as $detail) {
                    if (!$detail->isAssignedToCC) {
                        $detail->update([$controllerDbColumn => $controller]);
                    }
                }
                $controller = User::findOrFail($controller);
                $processes = Process::whereIn('id', $processes)->get();
                Notification::send($controller, new MissionDetailAssigned($controller, $mission, $processes));

                return true;
            });

            if ($result) {
                $message = "Assignation des processus avec succès";
            } else {
                $message = "Une erreur s'est produite lors de la tentative d'assignation des processus";
                $result = false;
            }

            return actionResponse($result, $message, $message);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    public function getAssignedProcesses(Mission $mission, User $user)
    {
        $userDetails = $user->details($user)->with('process')->where('mission_id', $mission->id)->pluck('control_point_id')->toArray();
        $pcf = DB::table('families as f')
            ->select('f.name as family_name', 'f.id as family_id', 'd.name as domain_name', 'd.id as domain_id', 'p.name as process_name', 'p.id as process_id')
            ->join('domains as d', 'f.id', '=', 'd.family_id')
            ->join('processes as p', 'd.id', '=', 'p.domain_id')
            ->join('control_points as cp', 'p.id', '=', 'cp.process_id')
            ->whereIn('cp.id', $userDetails)
            ->groupBy('f.name', 'f.id', 'd.name', 'd.id', 'p.name', 'p.id')
            ->paginate();

        return response()->json($pcf);
    }

    public function getNotDispatchedProcesses(Mission $mission, string $type)
    {
        hasRoleOrAbort('cdcr');
        if (in_array($type, ['ci', 'cc'])) {
            $pcfList = $mission->notDispatchedProcesses($type);
            return response()->json($pcfList);
        } else {
            abort(500, "Le type $type est un type inconnu");
        }
    }

    public function destroy(Mission $mission, Process $process, User $user, string $type)
    {
        try {
            $results = DB::transaction(function () use ($mission, $process, $user, $type) {
                $userDetails = $user->details($user)->where('mission_id', $mission->id)->whereRelation('process', 'processes.id', $process->id)->get();
                $results = collect([]);
                foreach ($userDetails as $detail) {
                    $results->push($detail->update(['assigned_to_' . $type . '_id' => null]));
                }
                return $results->hasAny(false);
            });
            return actionResponse($results, 'Détachement du processus avec succès !');
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }
}
