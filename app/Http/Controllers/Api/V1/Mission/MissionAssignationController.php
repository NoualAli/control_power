<?php

namespace App\Http\Controllers\Api\V1\Mission;

use App\Enums\EventLogTypes;
use App\Enums\MissionState;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\AssignMissionProcessesRequest;
use App\Models\EventLog;
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
        // dd(auth()->user()->role->code, $type);
        hasRoleOrAbort(['cdcr', 'der']);
        if (in_array($type, ['ci', 'cc', 'cder'])) {
            if ($type == 'cc') {
                $controllersList = formatForSelect(User::whereRoles(['cc'])->get()->filter(fn ($controller) => !$controller->total_mission_details)->toArray(), 'full_name');
                $controller = $mission->assigned_to_cc_id;
                return compact('controller', 'controllersList');
            } elseif ($type == 'ci') {
                $pcfList = $mission->notDispatchedProcesses($type);
                $controllersList = User::whereRoles(['cc'])->get();

                $userIds = $controllersList->pluck('id')->toArray();

                $controllersList = formatForSelect($controllersList->filter(fn ($controller) => !$controller->total_mission_details)->toArray(), 'full_name');
                return  compact('pcfList', 'controllersList');
            } elseif ($type == 'cder') {
                $controllersList = formatForSelect(User::whereRoles(['cder'])->get()->filter(fn ($controller) => !$controller->total_mission_details)->toArray(), 'full_name');
                $controller = $mission->assigned_to_cder_id;
                return compact('controller', 'controllersList');
            }
        } else {
            abort(422, "Le type $type est un type inconnu");
        }
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
                $controller = $request->controller;
                $currentState = $mission->current_state;

                if ($type == 'cc') {
                    $currentState = MissionState::PENDING_CC_VALIDATION;
                }

                if ($controller) {
                    $controller = User::findOrFail($controller);
                    $data = ['assigned_to_' . $type . '_id' => $controller->id, 'current_state' => $currentState];
                    if ($type == 'cder') {
                        $data = array_merge($data, ['assigned_to_cder_at' => now()]);
                    }
                    $mission->update($data);
                    EventLog::store([
                        'type' => EventLogTypes::DISPATCH,
                        'attachable_type' => Mission::class,
                        'attachable_id' => $mission->id,
                        'payload' => [
                            'success' => true,
                            'content' => "Assignation de la mission $mission->reference à " . $controller->full_name_with_martial
                        ]
                    ]);
                    Notification::send($controller, new MissionDetailAssigned($controller, $mission));
                } else {
                    if (hasRole('cdcr')) {
                        $currentState = MissionState::PENDING_CDCR_VALIDATION;
                    }
                    $mission->update(['assigned_to_' . $type . '_id' => NULL, 'current_state' => $currentState]);
                }

                return true;
            });

            if ($result) {
                $message = "Assignation de la mission <b>$mission->reference</b> avec succès";
            } else {
                $message = "Une erreur s'est produite lors de la tentative d'assignation des processus";
                $result = false;
            }

            return actionResponse($result, $message, $message);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    /**
     * Fetch assigned process to cc or ci
     *
     * @param Mission $mission
     * @param User $user
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function getAssignedProcesses(Mission $mission, User $user)
    {
        $dbColumn = hasRole('cdc') ? 'assigned_to_ci_id' : 'assigned_to_cc_id';

        $details = DB::table('mission_details as md')->where('md.mission_id', $mission->id)->where(function ($query) use ($user, $dbColumn) {
            $query->where('md.' . $dbColumn, $user->id)->orWhere('m.' . $dbColumn, $user->id);
        })->leftJoin('missions as m', 'm.id', '=', 'md.mission_id')->get()->pluck('control_point_id')->toArray();

        $pcf = DB::table('families as f')
            ->select('f.name as family_name', 'f.id as family_id', 'd.name as domain_name', 'd.id as domain_id', 'p.name as process_name', 'p.id as process_id')
            ->join('domains as d', 'f.id', '=', 'd.family_id')
            ->join('processes as p', 'd.id', '=', 'p.domain_id')
            ->join('control_points as cp', 'p.id', '=', 'cp.process_id')
            ->whereIn('cp.id', $details)
            ->groupBy('f.name', 'f.id', 'd.name', 'd.id', 'p.name', 'p.id')
            ->paginate();
        return response()->json($pcf);
    }

    /**
     * Fetch not yet dispatched processes
     *
     * @param Mission $mission
     * @param string $type [ci, cc]
     *
     * @return Illuminate\Http\JsonResponse
     */
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

    /**
     * Detach assigned process
     *
     * @param Mission $mission
     * @param Process $process
     * @param User $user
     * @param string $type [ci, cc]
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function destroy(Mission $mission, Process $process, User $user, string $type)
    {
        try {
            $results = DB::transaction(function () use ($mission, $process, $user, $type) {
                $controlPoints = $process->control_points->pluck('id')->toArray();
                $userMissionByControlPointsDetails = DB::table('mission_details')->whereIn('control_point_id', $controlPoints)->where('assigned_to_' . $type . '_id', $user->id);
                $userMissionDetailsUpdated = $userMissionByControlPointsDetails->update(['assigned_to_' . $type . '_id' => NULL]);
                $userMissionByDetails = DB::table('mission_details')->where('assigned_to_' . $type . '_id', $user->id)->get()->count();
                if (!$userMissionByDetails) {
                    $mission->update(['assigned_to_' . $type . '_id' => NULL]);
                }
                return $userMissionDetailsUpdated;
            });

            return actionResponse($results, 'Détachement du processus avec succès !');
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }
}
