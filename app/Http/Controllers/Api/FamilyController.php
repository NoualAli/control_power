<?php

namespace App\Http\Controllers\Api;

use App\Exports\FamiliesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Family\StoreRequest;
use App\Http\Requests\Family\UpdateRequest;
use App\Http\Resources\FamilyResource;
use App\Models\Domain;
use App\Models\Family;
use App\Services\ExcelExportService;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use stdClass;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $families = getFamilies();

        $search = request('search', null);
        $sort = request('sort', null);
        $filter = request('filter', null);
        $perPage = request('perPage', 10);
        $fetchAll = request()->has('fetchAll');
        $withChildren = request()->has('withChildren');
        $usableForAgencies = request()->has('usableForAgencies');
        $usableForDres = request()->has('usableForDres');

        $export = request('export', []);
        $shouldExport = count($export);

        if ($sort) {
            $families = $families->reorder();
            $families = $families->sortByMultiple($sort);
        }
        if ($search) {
            $columns = ['f.name'];
            $families = $families->search($columns, $search);
        }

        if ($usableForAgencies && !$usableForDres) {
            $families = $families->where('f.usable_for_agency', true);
        }

        if ($usableForDres && !$usableForAgencies) {
            $families = $families->where('f.usable_for_dre', true);
        }

        if ($usableForAgencies && $usableForDres) {
            $families = $families->where(function ($query) {
                $query->where('f.usable_for_dre', true)->orWhere('f.usable_for_agency', true);
            });
        }

        if ($shouldExport) {
            return (new ExcelExportService($families, FamiliesExport::class, 'liste_des_familles.xlsx', $export))->download();
        }

        if ($fetchAll && $withChildren) {
            return getPCF($families);
        } elseif ($fetchAll && !$withChildren) {
            return formatForSelect($families->get()->toArray());
        } else {
            isAbleOrAbort('view_family');
            return FamilyResource::collection($families->paginate($perPage)->onEachSide(1));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Family\StoreRequest  $request*
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        try {

            $result = DB::transaction(function () use ($request) {
                $data = $request->validated();
                $data['display_priority'] = round($data['display_priority']);
                $data['creator_full_name'] = getUserFullNameWithRole();
                $data['created_at'] = now();
                $family = Family::create($data);
                $data['id'] = $family->id;
                $updatedFamilies = $this->updateFamilies($data);
                return $family->id;
            });

            return actionResponse($result, CREATE_SUCCESS);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param string $family
     * @return JsonResponse
     */
    public function show(string $family): JsonResponse
    {
        isAbleOrAbort('view_family');
        $families = explode(',', $family);
        $onlyDomains = request()->has('onlyDomains');
        $family = !$onlyDomains
            ? getFamilies($family)
            : formatForSelect(Domain::whereIn('family_id', $families)->get()->toArray());
        if (!$onlyDomains) {
            $domains = getDomains()->where('f.id', $family->id)->get();
            $family->domains = $domains;
            foreach ($domains as $domain) {
                $domain->processes = getProcesses()->where('domain_id', $domain->id)->get();
            }
        }
        return response()->json($family);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Family\UpdateRequest $request
     * @param App\Models\Family $family
     *
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Family $family): JsonResponse
    {
        try {
            $result = DB::transaction(function () use ($request, $family) {
                $data = $request->validated();
                $result = true;
                $updateOthersPriority = $data['update_others_priority'];
                unset($data['update_others_priority']);
                $data['display_priority'] = round($data['display_priority']);
                $data['id'] = $family->id;
                $data['updater_full_name'] = getUserFullNameWithRole();
                $data['updated_at'] = now();
                $result = $family->update($data);
                $family->domains()->update(['usable_for_agency' => $data['usable_for_agency'], 'usable_for_dre' => $data['usable_for_dre'], 'is_active' => $data['is_active']]);
                foreach ($family->domains as $domain) {
                    $domain->processes()->update(['usable_for_agency' => $data['usable_for_agency'], 'usable_for_dre' => $data['usable_for_dre'], 'is_active' => $data['is_active']]);
                    foreach ($domain->processes as $process) {
                        $process->control_points()->update(['usable_for_agency' => $data['usable_for_agency'], 'usable_for_dre' => $data['usable_for_dre'], 'is_active' => $data['is_active']]);
                    }
                }
                if ($updateOthersPriority && $result) {
                    $updatedFamilies = $this->updateFamilies($data);
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
     * @param Family $family
     *
     * @return JsonResponse
     */
    public function toggleState(Family $family): JsonResponse
    {
        try {
            $currentState = $family->is_active;
            $result = DB::transaction(function () use ($family, $currentState) {
                $updatedAt = now();
                $updaterFullname = getUserFullNameWithRole();
                $result = $family->update(['is_active' => !$currentState, 'updated_at' => $updatedAt, 'updater_full_name' => $updaterFullname]);
                foreach ($family->domains as $domain) {
                    $result = $domain->update(['is_active' => !$currentState, 'updated_at' => $updatedAt, 'updater_full_name' => $updaterFullname]);
                    if (!$result) return $result;
                    foreach ($domain->processes as $process) {
                        $result = $process->update(['is_active' => !$currentState, 'updated_at' => $updatedAt, 'updater_full_name' => $updaterFullname]);
                        if (!$result) return $result;
                        foreach ($process->control_points as $controlPoint) {
                            $result = $controlPoint->update(['is_active' => !$currentState, 'updated_at' => $updatedAt, 'updater_full_name' => $updaterFullname]);
                            if (!$result) return $result;
                        }
                    }
                }

                return $result;
            });
            $successMessage = $currentState ? "La famille a été désactiver avec succès" : "La famille a été activer avec succès";
            $code = $result ? 200 : 422;
            $errorMessage = DEFAULT_ERROR_MESSAGE;
            if (!$result) {
                $errorMessage = $currentState ? "Une erreur est survenue lors de la tentative de désactivation de la famille $family->name" : "Une erreur est survenue lors de la tentative de d'activation de la famille $family->name";
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
     * @param int $family
     * @return JsonResponse
     */
    public function destroy(int $family): JsonResponse
    {
        isAbleOrAbort('delete_family');
        try {
            $family = getFamilies($family);
            if (!$family->is_deletable) abort(422, 'Une famille déjà utilisée dans une campagne de contrôle ne peut pas être supprimée.');
            $result = false;
            $errorMessage = DELETE_ERROR;
            $result = DB::transaction(function () use ($family) {
                $data['usable_for_agency'] = $family->usable_for_agency;
                $data['usable_for_dre'] = $family->usable_for_dre;
                $data['is_active'] = $family->is_active;
                $data['id'] = $family->id;
                $data['display_priority'] = $family->display_priority;
                $familyDeleted = DB::table('families')->delete($family->id);
                $updatedFamilies = $this->updateFamilies($data);
                return $familyDeleted;
            });
            return actionResponse($result, DELETE_SUCCESS, $errorMessage);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    /**
     * Fetch config used when creating new family or update existing one
     *
     * @param string|null $family
     *
     * @return JsonResponse
     */
    public function config(?string $family = null): JsonResponse
    {
        $usableForAgency = filter_var(request('usable_for_agency', false), FILTER_VALIDATE_BOOL);
        $usableForDRE = filter_var(request('usable_for_dre', false), FILTER_VALIDATE_BOOL);
        $isActive = filter_var(request('is_active', false), FILTER_VALIDATE_BOOL);
        $display_priority = 1;
        $families = getFamilies()
            ->where('f.usable_for_agency', $usableForAgency)
            ->where('f.usable_for_dre', $usableForDRE)
            ->where('f.is_active', $isActive);

        $family = (clone $families)->get()->last() ?: new stdClass;
        $display_priority = property_exists($family, 'display_priority') ? $family->display_priority + 1 : 1;

        return response()->json(compact('display_priority'));
    }

    /**
     * @param array $data
     *
     * @return void
     */
    private function updateFamilies(array $data): void
    {
        $families = getFamilies()->where(function ($query) use ($data) {
            $query->where('f.usable_for_agency', $data['usable_for_agency'])->where('f.usable_for_dre', $data['usable_for_dre']);
        })->where('f.is_active', true);

        $updated = collect();
        (clone $families)->where('f.id', $data['id'])->update(['f.display_priority' => $data['display_priority'], 'updated_at' => now(), 'updater_full_name' => getUserFullNameWithRole()]);
        $families = (clone $families)->pluck('id')->toArray();
        foreach ($families as $key => $id) {
            $display_priority = $key + 1;
            $result = DB::table('families')->where('id', $id)->update(['display_priority' => $display_priority, 'updated_at' => now(), 'updater_full_name' => getUserFullNameWithRole()]);
            $updated->push($result);
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
    private function filter(Builder $family, array $filter): Builder
    {
        if (isset($filter['usable_for_agency'])) {
            $usable_for_agency = boolval($filter['usable_for_agency']);
            $family = $family->where('f.usable_for_agency', $usable_for_agency);
        }

        if (isset($filter['usable_for_dre'])) {
            $usable_for_dre = boolval($filter['usable_for_dre']);
            $family = $family->where('f.usable_for_dre', $usable_for_dre);
        }

        if (isset($filter['is_active'])) {
            $is_active = boolval($filter['is_active']);
            $family = $family->where('f.is_active', $is_active);
        }

        return $family;
    }
}
