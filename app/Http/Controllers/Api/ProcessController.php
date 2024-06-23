<?php

namespace App\Http\Controllers\Api;

use App\Exports\ProcessesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Process\StoreRequest;
use App\Http\Requests\Process\UpdateRequest;
use App\Http\Resources\ProcessResource;
use App\Models\ControlPoint;
use App\Models\Process;
use App\Services\ExcelExportService;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use stdClass;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processes = getProcesses();

        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request()->has('fetchAll');

        if ($fetchFilters) {
            return $this->filters();
        }

        if ($filter) {
            $processes = $this->filter($processes, $filter);
        }

        if ($sort) {
            $processes = $processes->reorder();
            $processes = $processes->sortByMultiple($sort);
        }
        if ($search) {
            $columns = ['p.name'];
            $processes = $processes->search($columns, $search);
        }

        $export = request('export', []);
        $shouldExport = count($export);

        if ($shouldExport) {
            return (new ExcelExportService($processes, ProcessesExport::class, 'liste_des_processus.xlsx', $export))->download();
        }

        $processes = $fetchAll ? $processes->get()->toJson() : ProcessResource::collection($processes->paginate($perPage)->onEachSide(1));
        return $processes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Process\StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $result = DB::transaction(function () use ($request) {
                $data = $request->validated();
                $data['creator_full_name'] = getUserFullNameWithRole();
                $data['created_at'] = now();
                $data['display_priority'] = round($data['display_priority']);
                $process = Process::create($data);
                if (isset($data['regulations']) && !empty($data['regulations'])) {
                    $process->media()->attach($data['regulations']);
                }
                $data['id'] = $process->id;
                $updatedDomains = $this->updateProcesses($data);
                return $process->id;
            });
            return actionResponse($result, CREATE_SUCCESS);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param string $process
     * @return JsonResponse
     */
    public function show(string $process): JsonResponse
    {
        $processes = explode(',', $process);
        $onlyControlPoints = request()->has('onlyControlPoints');
        $process = $onlyControlPoints ? formatForSelect(ControlPoint::whereIn('process_id', $processes)->get()->toArray()) : getProcesses($process);
        if (gettype($process) == 'object') {
            $media = getMedia()->where('attachable_id', $process->id)->where('attachable_type', Process::class)->get()->map(function ($item) {
                $item->icon = getMediaIcon($item);
                $item->link = getMediaStorageLink($item->folder, $item->hash_name);
                $item->payload = json_decode($item->payload);
                return $item;
            });
            $process->regulations_id = $media->pluck('id')->toArray();
            $process->regulations = formatForSelect(getRegulations()->toArray(), 'original_name');
            $process->formatted_media = $media->groupBy('category');
            $controlPoints = getControlPoints()->where('p.id', $process->id)->get();
            $process->control_points = $controlPoints;
        }

        return response()->json($process);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Process\UpdateRequest $request
     * @param App\Models\Process $process
     *
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Process $process): JsonResponse
    {
        try {
            $data = $request->validated();
            $result = DB::transaction(function () use ($request, $process) {
                $data = $request->validated();
                $result = true;
                $updateOthersPriority = $data['update_others_priority'];
                unset($data['update_others_priority']);
                $data['id'] = $process->id;
                $data['display_priority'] = round($data['display_priority']);
                $data['domain_id'] = $process->domain_id;
                $data['family_id'] = $process->family->id;
                $data['updater_full_name'] = getUserFullNameWithRole();
                $data['updated_at'] = now();
                $data['current_display_priority'] = $process->display_priority;
                $data['family_id'] = isset($data['family_id']) ? $data['family_id'] : $process->family->id;
                $data['domain_id'] = isset($data['domain_id']) ? $data['domain_id'] : $process->doamin->id;
                if (isset($data['regulations']) && !empty($data['regulations'])) {
                    $process->media()->sync($data['regulations']);
                }
                $result = $process->update($data);
                if ($updateOthersPriority && $result) {
                    $updatedDomains = $this->updateProcesses($data);
                }

                return $result;
            });
            return actionResponse($result, UPDATE_SUCCESS);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    /**
     * Toggle the specified resource state in storage
     *
     * @param Process $process
     *
     * @return JsonResponse
     */
    public function toggleState(Process $process): JsonResponse
    {
        try {
            $currentState = $process->is_active;
            if (!$currentState && !$process->domain->is_active) return actionResponse(false,  "", "Vous ne pouvez pas activer ce processus tant que le domaine <b>" . $process->domain->name . "</b> est désactiver.", 200);
            $result = DB::transaction(function () use ($process, $currentState) {
                $updatedAt = now();
                $updaterFullname = getUserFullNameWithRole();
                $result = $process->update(['is_active' => !$currentState, 'updated_at' => $updatedAt, 'updater_full_name' => $updaterFullname]);

                foreach ($process->control_points as $controlPoint) {
                    $result = $controlPoint->update(['is_active' => !$currentState, 'updated_at' => $updatedAt, 'updater_full_name' => $updaterFullname]);
                    if (!$result) return $result;
                }

                return $result;
            });
            $successMessage = $currentState ? "Le processus a été désactiver avec succès" : "Le processus a été activer avec succès";
            $code = $result ? 200 : 422;
            $errorMessage = DEFAULT_ERROR_MESSAGE;
            if (!$result) {
                $errorMessage = $currentState ? "Une erreur est survenue lors de la tentative de désactivation du processus $process->name" : "Une erreur est survenue lors de la tentative de d'activation du processus $process->name";
                $code = 500;
            }
            return actionResponse($result, $successMessage, $errorMessage, $code);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $process
     * @return JsonResponse
     */
    public function destroy(int $process): JsonResponse
    {
        isAbleOrAbort('delete_process');
        try {
            $process = getProcesses($process);
            if (!$process->is_deletable) abort(422, 'Un processus déjà utilisée dans une campagne de contrôle ne peut pas être supprimée.');
            $result = DB::transaction(function () use ($process) {
                $data['usable_for_agency'] = $process->usable_for_agency;
                $data['usable_for_dre'] = $process->usable_for_dre;
                $data['is_active'] = $process->is_active;
                $data['id'] = $process->id;
                $data['family_id'] = $process->family->id;
                $data['domain_id'] = $process->domain_id;
                $data['display_priority'] = $process->display_priority;
                $processDeleted = DB::table('processes')->delete($process->id);
                $updatedProcesses = $this->updateProcesses($data);
                return $processDeleted;
            });
            return actionResponse($result, DELETE_SUCCESS);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    /**
     * Filter data
     *
     * @param Builder $processes
     * @param array $filter
     *
     * @return Builder
     */
    private function filter(Builder $processes, array $filter): Builder
    {
        if (isset($filter['family'])) {
            $families = explode(',', $filter['family']);
            $processes = $processes->whereIn('d.family_id', $families);
        }

        if (isset($filter['domain'])) {
            $domains = explode(',', $filter['domain']);
            $processes = $processes->whereIn('p.domain_id', $domains);
        }

        if (isset($filter['usable_for_agency'])) {
            $usable_for_agency = boolval($filter['usable_for_agency']);
            $processes = $processes->where('p.usable_for_agency', $usable_for_agency);
        }

        if (isset($filter['usable_for_dre'])) {
            $usable_for_dre = boolval($filter['usable_for_dre']);
            $processes = $processes->where('p.usable_for_dre', $usable_for_dre);
        }

        if (isset($filter['is_active'])) {
            $is_active = boolval($filter['is_active']);
            $processes = $processes->where('p.is_active', $is_active);
        }

        return $processes;
    }

    /**
     * Fetch filters data
     *
     * @return array
     */
    private function filters(): array
    {
        $filters = request('filter');
        $family = getFamilies()->select('f.id', 'f.name');

        if (isset($filters['family'])) {
            $families = explode(',', $filters['family']);
            $domains = getDomains()->select('d.id', 'd.name')->whereIn('f.id', $families);
        }

        $family = formatForSelect($family->get()->toArray());
        $domain = isset($filters['family']) ? formatForSelect($domains->get()->toArray()) : [];
        return compact('family', 'domain');
    }

    /**
     * Fetch config used when creating new process or update existing one
     *
     * @param string|null $domain
     *
     * @return array
     */
    public function config(?string $process = null): JsonResponse
    {
        $usableForAgency = filter_var(request('usable_for_agency', false), FILTER_VALIDATE_BOOL);
        $usableForDRE = filter_var(request('usable_for_dre', false), FILTER_VALIDATE_BOOL);
        $isActive = filter_var(request('is_active', false), FILTER_VALIDATE_BOOL);
        $family = request('family');
        $domain = request('domain');
        $display_priority = 1;
        $processes = getProcesses()
            ->where('p.usable_for_agency', $usableForAgency)
            ->where('p.usable_for_dre', $usableForDRE)
            ->where('p.is_active', $isActive);

        if ($family) {
            $processes = $processes->where('f.id', $family);
        }

        if ($domain) {
            $processes = $processes->where('d.id', $domain);
        }

        $process = (clone $processes)->get()->last() ?: new stdClass;
        $display_priority = property_exists($process, 'display_priority') ? $process->display_priority + 1 : 1;

        return response()->json(compact('display_priority'));
    }

    /**
     * @param array $data
     *
     * @return void
     */
    private function updateProcesses(array $data): void
    {
        $processes = getProcesses()->where(function ($query) use ($data) {
            $query->where('p.usable_for_agency', $data['usable_for_agency'])->where('p.usable_for_dre', $data['usable_for_dre']);
        })->where('p.is_active', true)->where(fn ($query) => $query->where('d.family_id', $data['family_id'])->where('p.domain_id', $data['domain_id']));
        $updated = collect();

        (clone $processes)->where('p.id', $data['id'])->update(['p.display_priority' => $data['display_priority'], 'updated_at' => now(), 'updater_full_name' => getUserFullNameWithRole()]);
        $processes = (clone $processes)->pluck('id')->toArray();
        foreach ($processes as $key => $id) {
            $display_priority = $key + 1;
            $result = DB::table('processes')->where('id', $id)->update(['display_priority' => $display_priority, 'updated_at' => now(), 'updater_full_name' => getUserFullNameWithRole()]);
            $updated->push($result);
        }
    }
}
