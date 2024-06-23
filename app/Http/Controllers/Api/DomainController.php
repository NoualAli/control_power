<?php

namespace App\Http\Controllers\Api;

use App\Exports\DomainsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Domains\StoreRequest;
use App\Http\Requests\Domains\UpdateRequest;
use App\Http\Resources\DomainResource;
use App\Models\Domain;
use App\Models\Process;
use App\Services\ExcelExportService;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use stdClass;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $domains = getDomains();

        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request()->has('fetchAll');

        $export = request('export', []);
        $shouldExport = count($export);

        if ($fetchFilters) {
            return $this->filters();
        }


        if ($filter) {
            $domains = $this->filter($domains, $filter);
        }

        if ($sort) {
            $domains = $domains->reorder();
            $domains = $domains->sortByMultiple($sort);
        }
        if ($search) {
            $domains = $domains->search(['d.name'], $search);
        }

        if ($shouldExport) {
            return (new ExcelExportService($domains, DomainsExport::class, 'liste_des_domaines.xlsx', $export))->download();
        }
        $domains = $fetchAll ? $domains->get()->toJson() : DomainResource::collection($domains->paginate($perPage)->onEachSide(1));
        return $domains;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Domain\StoreRequest  $request
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
                $domain = Domain::create($data);
                $data['id'] = $domain->id;
                $data['family_id'] = $domain->family_id;
                $updatedDomains = $this->updateDomains($data);
                return $domain->id;
            });

            return actionResponse($result, CREATE_SUCCESS);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param string $domain
     * @return JsonResponse
     */
    public function show(string $domain): JsonResponse
    {
        $domains = explode(',', $domain);
        $onlyProcesses = request()->has('onlyProcesses');
        $domain = $onlyProcesses ? formatForSelect(Process::whereIn('domain_id', $domains)->get()->toArray()) :
            getDomains($domain);
        if (!$onlyProcesses) {
            $processes = getProcesses()->where('d.id', $domain->id)->get();
            $domain->processes = $processes;
            foreach ($processes as $process) {
                $process->control_points = getControlPoints()->where('process_id', $process->id)->get();
            }
        }
        return response()->json($domain);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Domain\UpdateRequest $request
     * @param App\Models\Domain $domain
     *
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Domain $domain): JsonResponse
    {
        try {
            $result = DB::transaction(function () use ($request, $domain) {
                $data = $request->validated();
                $result = true;
                $updateOthersPriority = $data['update_others_priority'];
                unset($data['update_others_priority']);
                $data['id'] = $domain->id;
                $data['display_priority'] = round($data['display_priority']);
                $data['updater_full_name'] = getUserFullNameWithRole();
                $data['updated_at'] = now();
                $data['family_id'] = isset($data['family_id']) ? $data['family_id'] : $domain->family_id;
                $result = $domain->update($data);
                if ($updateOthersPriority && $result) {
                    $updatedDomains = $this->updateDomains($data);
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
     * @param Domain $domain
     *
     * @return JsonResponse
     */
    public function toggleState(Domain $domain): JsonResponse
    {
        try {
            $currentState = $domain->is_active;
            if (!$currentState && !$domain->family->is_active) return actionResponse(false,  "",  "Vous ne pouvez pas activer ce processus tant que la famille <b>" . $domain->family->name . "</b> est désactiver.", 200);
            $result = DB::transaction(function () use ($domain, $currentState) {
                $updatedAt = now();
                $updaterFullname = getUserFullNameWithRole();
                $result = $domain->update(['is_active' => !$currentState, 'updated_at' => $updatedAt, 'updater_full_name' => $updaterFullname]);

                foreach ($domain->processes as $process) {
                    $result = $process->update(['is_active' => !$currentState, 'updated_at' => $updatedAt, 'updater_full_name' => $updaterFullname]);
                    if (!$result) return $result;
                    foreach ($process->control_points as $controlPoint) {
                        $result = $controlPoint->update(['is_active' => !$currentState, 'updated_at' => $updatedAt, 'updater_full_name' => $updaterFullname]);
                        if (!$result) return $result;
                    }
                }

                return $result;
            });
            $successMessage = $currentState ? "Le domaine a été désactiver avec succès" : "Le domaine a été activer avec succès";
            $code = $result ? 200 : 422;
            $errorMessage = DEFAULT_ERROR_MESSAGE;
            if (!$result) {
                $errorMessage = $currentState ? "Une erreur est survenue lors de la tentative de désactivation du domaine $domain->name" : "Une erreur est survenue lors de la tentative de d'activation du domaine $domain->name";
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
     * @param int $domain
     * @return JsonResponse
     */
    public function destroy(int $domain): JsonResponse
    {
        isAbleOrAbort('delete_domain');
        try {
            $domain = getDomains($domain);
            if (!$domain->is_deletable) abort(422, 'Un domaine déjà utilisée dans une campagne de contrôle ne peut pas être supprimée.');
            $result = DB::transaction(function () use ($domain) {
                $data['usable_for_agency'] = $domain->usable_for_agency;
                $data['usable_for_dre'] = $domain->usable_for_dre;
                $data['is_active'] = $domain->is_active;
                $data['id'] = $domain->id;
                $data['family_id'] = $domain->family_id;
                $data['display_priority'] = $domain->display_priority;
                $domainDeleted = DB::table('domains')->delete($domain->id);
                $updatedDomains = $this->updateDomains($data);
                return $domainDeleted;
            });
            return actionResponse($result, DELETE_SUCCESS);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    /**
     * Filter data
     *
     * @param Builder $domains
     * @param array $filter
     *
     * @return Builder
     */
    private function filter(Builder $domains, array $filter): Builder
    {
        if (isset($filter['family'])) {
            $families = explode(',', $filter['family']);
            $domains = $domains->whereIn('family_id', $families);
        }

        if (isset($filter['usable_for_agency'])) {
            $usable_for_agency = boolval($filter['usable_for_agency']);
            $domains = $domains->where('d.usable_for_agency', $usable_for_agency);
        }

        if (isset($filter['usable_for_dre'])) {
            $usable_for_dre = boolval($filter['usable_for_dre']);
            $domains = $domains->where('d.usable_for_dre', $usable_for_dre);
        }

        if (isset($filter['is_active'])) {
            $is_active = boolval($filter['is_active']);
            $domains = $domains->where('d.is_active', $is_active);
        }

        return $domains;
    }

    /**
     * Fetch filters data
     *
     * @return array
     */
    private function filters(): array
    {
        $filters = request('filter');
        $family = getFamilies()->select('f.id', 'f.name')->get()->toArray();
        $family = formatForSelect($family);
        return compact('family');
    }

    /**
     * Fetch config used when creating new domain or update existing one
     *
     * @param string|null $domain
     *
     * @return JsonResponse
     */
    public function config(?string $domain = null): JsonResponse
    {
        $usableForAgency = filter_var(request('usable_for_agency', false), FILTER_VALIDATE_BOOL);
        $usableForDRE = filter_var(request('usable_for_dre', false), FILTER_VALIDATE_BOOL);
        $isActive = filter_var(request('is_active', false), FILTER_VALIDATE_BOOL);
        $family = request('family');
        $display_priority = 1;
        $domains = getDomains()
            ->where('d.usable_for_agency', $usableForAgency)
            ->where('d.usable_for_dre', $usableForDRE)
            ->where('d.is_active', $isActive);

        if ($family) {
            $domains = $domains->where('f.id', $family);
        }

        $domain = (clone $domains)->get()->last() ?: new stdClass;
        $display_priority = property_exists($domain, 'display_priority') ? $domain->display_priority + 1 : 1;

        return response()->json(compact('display_priority'));
    }

    /**
     * @param array $data
     *
     * @return void
     */
    private function updateDomains(array $data): void
    {
        $domains = getDomains()->where(function ($query) use ($data) {
            $query->where('d.usable_for_agency', $data['usable_for_agency'])->where('d.usable_for_dre', $data['usable_for_dre']);
        })->where('d.is_active', true)->where('d.family_id', $data['family_id']);

        $updated = collect();
        (clone $domains)->where('d.id', $data['id'])->update(['d.display_priority' => $data['display_priority'], 'updated_at' => now(), 'updater_full_name' => getUserFullNameWithRole()]);
        $domains = (clone $domains)->pluck('id')->toArray();
        foreach ($domains as $key => $id) {
            $display_priority = $key + 1;
            $result = DB::table('domains')->where('id', $id)->update(['display_priority' => $display_priority, 'updated_at' => now(), 'updater_full_name' => getUserFullNameWithRole()]);
            $updated->push($result);
        }
    }
}
