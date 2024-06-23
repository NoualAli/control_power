<?php

namespace App\Http\Controllers\Api\AgencyLevel\Mission;

use App\DB\Queries\MissionDetailQuery;
use App\DB\Queries\MissionProcessesQuery;
use App\Enums\EventLogTypes;
use App\Enums\MissionState;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\Detail\StoreComment;
use App\Http\Resources\MissionDetailResource;
use App\Http\Resources\MissionProcessesResource;
use App\Models\EventLog;
use App\Models\Mission;
use App\Models\Process;
use Illuminate\Database\Query\Builder;
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
                $processes = $this->sort($processes, $sort);
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

    public function controlPoints(string $mission, int $process)
    {
        $process = getProcesses($process);
        $controlPoints = getControlPoints()->where('p.id', $process->id)->where('cp.is_active', true)->select('cp.name')->get();
        $process->control_points = $controlPoints;
        return response()->json($process);
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
        canAccessMissionDetail($mission, $process);
        $media = getMedia()->where('attachable_id', $process->id)->where('attachable_type', Process::class)->get();
        $process->media = $media;
        $details = (new MissionDetailQuery)->prepare()->query->where('m.id', $mission->id)->where('p.id', $process->id)->get();
        $details = MissionDetailResource::collection($details);
        // dd($details);
        $mission->unsetRelations();
        $additional_anomaly = DB::table('comments')->where('commentable_type', Process::class)->where('commentable_id', $process->id)
            ->whereJsonContains('payload', ['related_commentable_type' => Mission::class, 'related_commentable_id' => $mission->id])->orderBy('created_at', 'DESC')->first();

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
        return compact('mission', 'details', 'process', 'additional_anomaly', 'mode');
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
     * Store additional anomalies for specified mission and process
     *
     * @param StoreComment $request
     * @param Mission $mission
     * @param Process $process
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeAdditionalAnomaly(StoreComment $request, Mission $mission, Process $process)
    {
        try {
            $result = DB::transaction(function ()  use ($request, $mission, $process) {
                $data = $request->validated();
                if (isset($data['content']) && !empty($data['content'])) {
                    $message = "Anomalie(s) supplémentaire enregistrer avec succès";
                    DB::table('comments')->updateOrInsert([
                        'payload' => json_encode(['related_commentable_type' => Mission::class, 'related_commentable_id' => $mission->id]),
                        'creator_full_name' => getUserFullNameWithRole(null, false),
                        'created_by_id' => auth()->user()->id,
                        'commentable_type' => Process::class,
                        'commentable_id' => $process->id,
                    ], [
                        'id' => \Illuminate\Support\Str::uuid(),
                        'content' => $data['content'],
                        'type' => 'additional_anomalies',
                        'creator_full_name' => getUserFullNameWithRole(null, false),
                        'created_at' => now(),
                        'updated_at' => now(),
                        'created_by_id' => auth()->user()->id,
                        'commentable_type' => Process::class,
                        'commentable_id' => $process->id,
                        'payload' => json_encode(['related_commentable_type' => Mission::class, 'related_commentable_id' => $mission->id])
                    ]);
                    // Mise à jour de la date réel du début de la mission
                    if (!$mission->real_start && $mission->current_state == MissionState::TODO) {
                        $mission->update(['real_start' => now(), 'current_state' => MissionState::ACTIVE]);
                    }
                } else {
                    $commentsQuery = DB::table('comments')->where('commentable_type', Process::class)->where('commentable_id', $process->id)
                        ->where('created_by_id', auth()->user()->id)
                        ->whereJsonContains('payload', ['related_commentable_type' => Mission::class, 'related_commentable_id' => $mission->id])->orderBy('created_at', 'DESC');
                    $commentsQuery->delete();
                    $message = "Anomalie(s) supplémentaire effacer avec succès";
                }
                return compact('message');
            });
            return actionResponse(true, $result['message']);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    private function sort(Builder $processes, array $sort)
    {
        $processes = $processes->reorder();
        foreach ($sort as $key => $value) {
            if ($key == 'control_rate') {
                if (hasRole('cdc')) {
                    $processes = $processes->orderByRaw('(100 * SUM(CASE WHEN md.controlled_by_cdc_at IS NOT NULL THEN 1 ELSE 0 END)) / NULLIF(COUNT(cp.id) - SUM(CASE WHEN md.is_disabled = 1 THEN 1 ELSE 0 END), 0)' . $value);
                } elseif (hasRole('cc')) {
                    $processes = $processes->orderByRaw('(100 * SUM(CASE WHEN md.controlled_by_cc_at IS NOT NULL THEN 1 ELSE 0 END)) / NULLIF(COUNT(cp.id) - SUM(CASE WHEN md.is_disabled = 1 THEN 1 ELSE 0 END), 0)' . $value);
                } elseif (hasRole('cdcr')) {
                    $processes = $processes->orderByRaw('(100 * SUM(CASE WHEN md.controlled_by_cdcr_at IS NOT NULL THEN 1 ELSE 0 END)) / NULLIF(COUNT(cp.id) - SUM(CASE WHEN md.is_disabled = 1 THEN 1 ELSE 0 END), 0)' . $value);
                } elseif (hasRole('dcp')) {
                    $processes = $processes->orderByRaw('(100 * SUM(CASE WHEN md.controlled_by_dcp_at IS NOT NULL THEN 1 ELSE 0 END)) / NULLIF(COUNT(cp.id) - SUM(CASE WHEN md.is_disabled = 1 THEN 1 ELSE 0 END), 0)' . $value);
                }
            } elseif ($key == 'anomalies_rate') {
                $processes = $processes->orderByRaw('(100 * COUNT(CASE WHEN score IN (2, 3, 4) THEN 1 ELSE NULL END)) / NULLIF(COUNT(CASE WHEN md.is_disabled = 0 THEN 1 ELSE NULL END), 0)' . $value);
            } elseif ($key == 'control_points_count') {
                $processes = $processes->orderByRaw('COUNT(cp.id) - SUM(CASE WHEN md.is_disabled = 1 THEN 1 ELSE 0 END) ' . $value);
            } elseif ($key == 'total_anomalies') {
                $processes = $processes->orderByRaw('COUNT(CASE WHEN score IN (2, 3, 4) THEN 1 ELSE NULL END)' . $value);
            } elseif ($key == 'avg_score') {
                $processes = $processes->orderByRaw('AVG(md.score)' . $value);
            } else {
                switch ($key) {
                    case 'control_rate_cdc':
                        $processes = $processes->orderByRaw('(100 * SUM(CASE WHEN md.controlled_by_cdc_at IS NOT NULL THEN 1 ELSE 0 END)) / NULLIF(COUNT(cp.id) - SUM(CASE WHEN md.is_disabled = 1 THEN 1 ELSE 0 END), 0)' . $value);
                        break;
                    case 'control_rate_cc':
                        $processes = $processes->orderByRaw('(100 * SUM(CASE WHEN md.controlled_by_cc_at IS NOT NULL THEN 1 ELSE 0 END)) / NULLIF(COUNT(cp.id) - SUM(CASE WHEN md.is_disabled = 1 THEN 1 ELSE 0 END), 0)' . $value);
                        break;
                    case 'control_rate_cdcr':
                        $processes = $processes->orderByRaw('(100 * SUM(CASE WHEN md.controlled_by_cdcr_at IS NOT NULL THEN 1 ELSE 0 END)) / NULLIF(COUNT(cp.id) - SUM(CASE WHEN md.is_disabled = 1 THEN 1 ELSE 0 END), 0)' . $value);
                        break;
                    case 'control_rate_dcp':
                        $processes = $processes->orderByRaw('(100 * SUM(CASE WHEN md.controlled_by_dcp_at IS NOT NULL THEN 1 ELSE 0 END)) / NULLIF(COUNT(cp.id) - SUM(CASE WHEN md.is_disabled = 1 THEN 1 ELSE 0 END), 0)' . $value);
                        break;
                    default:
                        $processes = $processes;
                        break;
                }
            }
        }

        return $processes;
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
