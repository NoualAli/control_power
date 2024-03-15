<?php

namespace App\Http\Controllers\Api\V1\Mission;

use App\DB\Queries\MissionProcessesQuery;
use App\Enums\EventLogTypes;
use App\Http\Controllers\Controller;
use App\Http\Resources\MissionProcessesResource;
use App\Models\EventLog;
use App\Models\Mission;
use App\Models\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MissionProcessController extends Controller
{
    /**
     * Fetch mission processes
     *
     * @param Mission $mission
     *
     * @return Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Mission $mission)
    {
        $mission->unsetRelations();
        $processes = (new MissionProcessesQuery($mission))->prepare()->multiple();

        $search = request('search', false);
        $sort = request('sort', false);

        if ($sort) {
            foreach ($sort as $key => $value) {
                $processes = $processes->orderBy($key, $value);
            }
        } else {
            $processes = $processes->orderBy('f.id')->orderBy('p.id');
        }
        $processes = $processes->get();

        if ($search) {
            $processes = $processes->filter(function ($process) use ($search) {
                return str_contains(trim(strtolower($process->process)), trim(strtolower($search)));
            });
        }

        $perPage = request('perPage', 10);

        return MissionProcessesResource::collection(paginate($processes, '/api/missions/' . $mission->id . '/processes', $perPage));
    }

    /**
     * Fetch mission details that belongs to specified process
     *
     * @param Mission $mission
     * @param Process $process
     *
     * @return array
     */
    public function show(Mission $mission, Process $process)
    {
        isAbleOrAbort(['view_mission', 'control_agency']);
        $checkProcess = (new MissionProcessesQuery($mission))->prepare()->single($process->id, 'p.id')->is_disabled;
        if (boolval(intval($checkProcess))) {
            abort(423, "Le processus $process->name est vérouillez");
        }
        $currentUser = auth()->user();
        $dreController = $mission->dreController->id;
        $dreAssistants = $mission->assistants->pluck('id')->toArray();
        $dcpController = $mission->assigned_to_cc_id;
        $agencies = $currentUser->agencies->pluck('id')->toArray();

        $condition = ($currentUser->id == $dreController
            || $currentUser->id == $dcpController
            || $mission->created_by_id == $currentUser->id
            || ($mission->assigned_to_cder_id == $currentUser->id && hasRole('cder'))
            || in_array(auth()->user()->id, $dreAssistants)
            || (hasRole(['cdcr', 'dcp']) && $mission->is_validated_by_cdc)
            || (hasRole(['dg', 'cdrcp', 'ig', 'der', 'sg', 'deac', 'dga']) && $mission->is_validated_by_dcp)
            || (hasRole(['dre', 'da']) && in_array($mission->agency->id, $agencies) && $mission->is_validated_by_dcp)
            || hasRole('root')
        );
        abort_if(!$condition, 401, __('unauthorized'));
        $details = $mission->details()->with(['observations', 'controlPoint' => fn ($query) => $query->with('fields')])->orderBy('control_point_id');
        $mission->unsetRelations();
        $process->load(['family', 'domain', 'media']);
        if (request()->has('onlyAnomaly')) {
            $details = $details->whereAnomaly();
        }
        $details = $details->whereRelation('process', 'processes.id', $process->id);
        $details = $details->get()->map(function ($detail) {
            if (hasRole('da')) {
                $detail->major_fact = false;
                $detail->major_fact_is_dispatched_by_full_name = null;
                $detail->major_fact_is_dispatched_to_dcp_by_full_name = null;
                $detail->major_fact_is_detected_by_full_name = null;
                $detail->major_fact_is_rejected_by_full_name = null;
                $detail->major_fact_is_rejected_at_dre = null;
                $detail->major_fact_is_rejected_at_dcp = null;
                $detail->major_fact_is_detected_by_id = null;
                $detail->major_fact_is_dispatched_to_dcp_by_id = null;
                $detail->major_fact_is_dispatched_by_id = null;
                $detail->major_fact_is_rejected_by_id = null;
                $detail->major_fact_is_detected_at = null;
                $detail->major_fact_is_rejected_at = null;
                $detail->major_fact_is_dispatched_at = null;
                $detail->major_fact_is_dispatched_to_dcp_at = null;
            }
            $detail->observation = $detail->observations()->first();
            return $detail;
        });

        $mode = false;
        if (hasRole(['ci'])) {
            $mode = 1; // Execution mode
        } elseif (hasRole('cdc')) {
            $mode = 2; // Revision mode
        } elseif (hasRole('cc')) {
            $mode = 3; // First processing mode
        } elseif (hasRole('cdcr')) {
            $mode = 4; // Second processing mode
        } elseif (hasRole('dcp')) {
            $mode = 5; // Third processing mode
        } else {
            $mode = 6; // Readonly mode
        }
        return compact('mission', 'details', 'process', 'mode');
    }

    /**
     * Lock mission details for specified process
     *
     * @param Mission $mission
     * @param Process $process
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lock(Mission $mission, Process $process)
    {
        hasRoleOrAbort(['cdc', 'ci']);
        try {
            $updated = 0;
            $errorMessage = DEFAULT_ERROR_MESSAGE;
            $details = DB::table('mission_details as md')
                ->leftJoin('control_points as cp', 'md.control_point_id', 'cp.id')
                ->leftJoin('processes as p', 'cp.process_id', 'p.id')
                ->where('p.id', $process->id)
                ->where('md.mission_id', $mission->id)
                ->where('is_disabled', false);
            if ($details->count()) {
                if ($details->count() == (clone $details)->whereNull('score')->count()) {
                    $updated = $details->update(['is_disabled' => true]);
                } else {
                    $errorMessage = "Impossible de verrouiller Le processus $process->name car le contrôleur a déjà entamer ce dernier.";
                }
            } else {
                $errorMessage = "Tous les points de contrôle liés au processus $process->name sont déjà verrouillés.";
            }
            $succesMessage = "Verrouillage du processus " . $process->name . " avec succès !";
            $updated = $updated > 0;
            $content = $updated ? $succesMessage : $errorMessage;

            EventLog::store(['type' => EventLogTypes::LOCK, 'attachable_type' => Process::class, 'attachable_id' => $process->id, 'payload' => ['success' => $updated, 'content' => $content]]);
            return actionResponse($updated, $succesMessage, $errorMessage);
        } catch (\Throwable $th) {
            EventLog::store(['type' => EventLogTypes::LOCK, 'attachable_type' => Process::class, 'attachable_id' => $process->id, 'payload' => ['success' => false, 'content' => $th->getMessage()]]);
            return throwedError($th);
        }
    }

    /**
     * Unlock mission details for specified process
     *
     * @param Mission $mission
     * @param Process $process
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function unlock(Mission $mission, Process $process)
    {
        hasRoleOrAbort(['cdc', 'ci']);
        try {
            $details = DB::table('mission_details as md')
                ->leftJoin('control_points as cp', 'md.control_point_id', 'cp.id')
                ->leftJoin('processes as p', 'cp.process_id', 'p.id')
                ->where('p.id', $process->id)
                ->where('md.mission_id', $mission->id)
                ->update(['is_disabled' => false]);
            $updated = $details > 0;
            $succesMessage = "Déverrouillage du processus " . $process->name . " avec succès !";
            $content = $updated ? $succesMessage : DEFAULT_ERROR_MESSAGE;
            EventLog::store(['type' => EventLogTypes::UNLOCK, 'attachable_type' => Process::class, 'attachable_id' => $process->id, 'payload' => ['success' => $updated, 'content' => $content]]);
            return actionResponse($details, $succesMessage);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    /**
     * Load filters data
     *
     * @param mixed $data
     *
     * @return Array
     */
    private function filters($data)
    {
        $family = formatForSelect((clone $data)->uniqueStrict('family')->map(fn ($item) => (array) $item)->toArray(), 'family', 'family');
        $domain = formatForSelect((clone $data)->uniqueStrict('domain')->map(fn ($item) => (array) $item)->toArray(), 'domain', 'domain');

        return  compact('family', 'domain');
    }

    /**
     * Filter data
     *
     * @param mixed $data
     *
     * @return Illuminate\Support\Collection
     */
    private function filter($data)
    {
        if (request()->has('filter') && !empty(request()->filter)) {
            foreach (request()->filter as $key => $value) {
                if (!empty($value)) {
                    $values = explode(',', $value);
                    if (!empty($values)) {
                        $data = $data->whereIn($key, $values);
                    }
                }
            }
        }

        if (request()->has('search') && !empty(request()->search)) {
            $data = $data->filter(fn ($process) => preg_match('/' . strtolower(request()->search) . '/', strtolower($process->process)));
        }

        return $data;
    }
}