<?php

namespace App\Http\Controllers\Api;

use App\Exports\ControlPointsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ControlPoint\StoreRequest;
use App\Http\Requests\ControlPoint\UpdateRequest;
use App\Http\Resources\ControlPointResource;
use App\Models\ControlPoint;
use App\Services\ExcelExportService;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use stdClass;

class ControlPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        isAbleOrAbort('view_control_point');

        $controlPoints = getControlPoints();

        $search = request('search', null);
        $sort = request('sort', null);
        $filter = request('filter', null);
        $fetchFilters = request()->has('fetchFilters');
        $fetchAll = request('fetchAll', false);
        $export = request('export', []);
        $perPage = request('perPage', 10);
        $shouldExport = count($export);

        // if ($shouldExport) {
        //     return (new ExcelExportService($controlPoints, ControlPointsExport::class, 'liste_des_points_de_contrôle.xlsx', $export))->download();
        // }
        if ($fetchFilters) {
            return $this->filters();
        }
        if ($filter) {
            $controlPoints = $this->filter($controlPoints, $filter);
        }

        if ($sort) {
            $controlPoints = $controlPoints->reorder();
            $controlPoints = $controlPoints->sortByMultiple($sort);
        }
        if ($search) {
            $columns = ['cp.name'];
            $controlPoints = $controlPoints->search($columns, $search);
        }

        $controlPoints = $fetchAll ? $controlPoints->get()->toJson() : ControlPointResource::collection($controlPoints->paginate($perPage)->onEachSide(1));
        return $controlPoints;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\ControlPoint\StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        try {
            $result = DB::transaction(function () use ($data) {
                $data['scores'] = count($data['scores']) ? $data['scores'] : null;
                $fields = $data['sampling_fields'];
                $data['creator_full_name'] = getUserFullNameWithRole();
                $data['created_at'] = now();
                $data['display_priority'] = round($data['display_priority']);
                $controlPoint = ControlPoint::create($data);
                $data['id'] = $controlPoint->id;
                $this->updateControlPoints($data);
                $controlPoint->fields()->sync($fields);
                return $controlPoint;
            });
            $result = $result->id;
            return actionResponse($result, CREATE_SUCCESS, CREATE_ERROR);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param App\Models\ControlPoint $controlPoint
     * @return JsonResponse
     */
    public function show(ControlPoint $controlPoint): JsonResponse
    {
        isAbleOrAbort('view_control_point');
        $controlPoint->load(['family', 'domain', 'process', 'fields']);
        return response()->json($controlPoint);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\ControlPoint\UpdateRequest $request
     * @param App\Models\ControlPoint $controlPoint
     *
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, ControlPoint $controlPoint): JsonResponse
    {
        try {
            $data = $request->validated();
            $status = DB::transaction(function () use ($controlPoint, $data) {
                if (is_null($controlPoint->scores) || empty($controlPoint->scores)) {
                    $data['scores'] = $data['scores'] ?: null;
                }
                $fields = $data['sampling_fields'];
                $data['updater_full_name'] = getUserFullNameWithRole();
                $data['updated_at'] = now();
                $data['display_priority'] = round($data['display_priority']);

                $update = $controlPoint->update($data);
                $data['id'] = $controlPoint->id;
                $this->updateControlPoints($data);
                $sync = $controlPoint->fields()->sync($fields);
                return $update && $sync;
            });

            return actionResponse($status, UPDATE_SUCCESS, UPDATE_SUCCESS);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    /**
     * Toggle the specified resource state in storage
     *
     * @param ControlPoint $controlPoint
     *
     * @return JsonResponse
     */
    public function toggleState(ControlPoint $controlPoint): JsonResponse
    {
        try {
            $currentState = $controlPoint->is_active;
            if (!$currentState && !$controlPoint->process->is_active) abort(422, "Vous ne pouvez pas activer ce point de contrôle tant que le processus <b>" . $controlPoint->process->name . "</b> est désactiver.");
            $result = DB::transaction(function () use ($controlPoint, $currentState) {
                $updatedAt = now();
                $updaterFullname = getUserFullNameWithRole();
                $result = $controlPoint->update(['is_active' => !$currentState, 'updated_at' => $updatedAt, 'updater_full_name' => $updaterFullname]);

                return $result;
            });
            $successMessage = $currentState ? "Le point de contrôle a été désactiver avec succès" : "Le point de contrôle a été activer avec succès";
            $code = $result ? 200 : 500;
            $errorMessage = DEFAULT_ERROR_MESSAGE;
            if (!$result) {
                $errorMessage = $currentState ? "Une erreur est survenue lors de la tentative de désactivation du point de contrôle $controlPoint->name" : "Une erreur est survenue lors de la tentative de d'activation du point de contrôle $controlPoint->name";
            }
            return actionResponse($result, $successMessage, $errorMessage, $code);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $controlPoint
     * @return JsonResponse
     */
    public function destroy(int $controlPoint): JsonResponse
    {
        isAbleOrAbort('delete_control_point');
        try {
            $controlPoint = getControlPoints($controlPoint);
            if (!$controlPoint->is_deletable) abort(422, 'Un point de contrôle déjà utilisée dans une campagne de contrôle ne peut pas être supprimée.');
            $result = DB::transaction(function () use ($controlPoint) {
                $data['usable_for_agency'] = $controlPoint->usable_for_agency;
                $data['usable_for_dre'] = $controlPoint->usable_for_dre;
                $data['is_active'] = $controlPoint->is_active;
                $data['id'] = $controlPoint->id;
                $data['family_id'] = $controlPoint->family_id;
                $data['domain_id'] = $controlPoint->domain_id;
                $data['process_id'] = $controlPoint->process_id;
                $data['display_priority'] = $controlPoint->display_priority;
                $controlPointDeleted = DB::table('control_points')->delete($controlPoint->id);
                $this->updateControlPoints($data);
                return $controlPointDeleted;
            });
            return actionResponse($result, DELETE_SUCCESS);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    /**
     * Fetch filters data
     *
     * @return array
     */
    public function filters(): array
    {

        $filters = request('filter');
        $families = getFamilies()->select('f.id', 'f.name');

        if (isset($filters['family'])) {
            $familyIds = explode(',', $filters['family']);
            $domains = getDomains()->select('d.id', 'd.name')->whereIn('f.id', $familyIds);
            if (isset($filters['domain'])) {
                $domainIds = explode(',', $filters['domain']);
                $processes = getProcesses()->select('p.id', 'p.name')->whereIn('d.id', $domainIds);
            }
        }

        $family = formatForSelect($families->get()->toArray());
        $domain = isset($filters['family']) ? formatForSelect($domains->get()->toArray()) : [];
        $process = isset($filters['domain']) ? formatForSelect($processes->get()->toArray()) : [];

        return compact('family', 'domain', 'process');
    }

    /**
     * Filter data
     *
     * @param Builder $processes
     * @param array $filter
     *
     * @return Builder
     */
    private function filter(Builder $controlPoints, array $filter): Builder
    {
        if (isset($filter['family'])) {
            $families = explode(',', $filter['family']);
            $controlPoints = $controlPoints->whereIn('f.id', $families);
        }

        if (isset($filter['domain'])) {
            $domains = explode(',', $filter['domain']);
            $controlPoints = $controlPoints->whereIn('d.id', $domains);
        }

        if (isset($filter['process'])) {
            $processes = explode(',', $filter['process']);
            $controlPoints = $controlPoints->whereIn('p.id', $processes);
        }

        if (isset($filter['major_fact'])) {
            $majorFact = boolval($filter['major_fact']);
            $controlPoints = $controlPoints->where('cp.has_major_fact', $majorFact);
        }

        if (isset($filter['with_metadata'])) {
            $value = $filter['with_metadata'];
            if ($value == 'Oui') {
                $controlPoints = $controlPoints->having(DB::raw('COUNT(hf.field_id)'), '>', 0);
            } else {
                $controlPoints = $controlPoints->having(DB::raw('COUNT(hf.field_id)'), '=', 0);
            }
        }

        if (isset($filter['usable_for_agency'])) {
            $usable_for_agency = boolval($filter['usable_for_agency']);
            $controlPoints = $controlPoints->where('cp.usable_for_agency', $usable_for_agency);
        }

        if (isset($filter['usable_for_dre'])) {
            $usable_for_dre = boolval($filter['usable_for_dre']);
            $controlPoints = $controlPoints->where('cp.usable_for_dre', $usable_for_dre);
        }

        if (isset($filter['is_active'])) {
            $is_active = boolval($filter['is_active']);
            $controlPoints = $controlPoints->where('cp.is_active', $is_active);
        }

        return $controlPoints;
    }

    /**
     * Fetch config used when creating new control point or update existing one
     *
     * @param string|null $controlPoint
     *
     * @return JsonResponse
     */
    public function config(?string $controlPoint = null): JsonResponse
    {
        $usableForAgency = filter_var(request('usable_for_agency', false), FILTER_VALIDATE_BOOL);
        $usableForDRE = filter_var(request('usable_for_dre', false), FILTER_VALIDATE_BOOL);
        $isActive = filter_var(request('is_active', false), FILTER_VALIDATE_BOOL);
        $family = request('family');
        $domain = request('domain');
        $process = request('process');
        $display_priority = 1;
        $controlPoints = getControlPoints()
            ->where('cp.usable_for_agency', $usableForAgency)
            ->where('cp.usable_for_dre', $usableForDRE)
            ->where('cp.is_active', $isActive);

        if ($family) {
            $controlPoints = $controlPoints->where('f.id', $family);
        }

        if ($domain) {
            $controlPoints = $controlPoints->where('d.id', $domain);
        }

        if ($process) {
            $controlPoints = $controlPoints->where('p.id', $process);
        }

        $controlPoint = (clone $controlPoints)->get()->last() ?: new stdClass;
        $display_priority = property_exists($controlPoint, 'display_priority') ? $controlPoint->display_priority + 1 : 1;

        return response()->json(compact('display_priority'));
    }

    /**
     * @param array $data
     *
     * @return void
     */
    private function updateControlPoints(array $data): void
    {
        $controlPoints = getControlPoints()->where(function ($query) use ($data) {
            $query->where('cp.usable_for_agency', $data['usable_for_agency'])->where('cp.usable_for_dre', $data['usable_for_dre']);
        })->where('cp.is_active', true)->where(fn ($query) => $query->where('f.id', $data['family_id'])->where('d.id', $data['domain_id'])->where('p.id', $data['process_id']));
        $updated = collect();
        (clone $controlPoints)->where('cp.id', $data['id'])->update(['cp.display_priority' => $data['display_priority'], 'updated_at' => now(), 'updater_full_name' => getUserFullNameWithRole()]);
        $controlPoints = (clone $controlPoints)->pluck('id')->toArray();
        foreach ($controlPoints as $key => $id) {
            $display_priority = $key + 1;
            $result = DB::table('control_points')->where('id', $id)->update(['display_priority' => $display_priority, 'updated_at' => now(), 'updater_full_name' => getUserFullNameWithRole()]);
            $updated->push($result);
        }
    }
}
