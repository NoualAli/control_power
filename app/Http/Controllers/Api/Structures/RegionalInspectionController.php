<?php

namespace App\Http\Controllers\Api\Structures;

use App\Exports\RegionalInspectionsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Structures\RegionalInspection\StoreRequest;
use App\Http\Requests\Structures\RegionalInspection\UpdateRequest;
use App\Http\Resources\Structures\RegionalInspectionResource;
use App\Models\Structures\Dre;
use App\Models\Structures\RegionalInspection;
use App\Models\User;
use App\Services\ExcelExportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class RegionalInspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        isAbleOrAbort(['view_regional_inspection', 'create_user', 'update_user']);
        $regionalInspections = RegionalInspection::withCount('dres');

        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request()->has('fetchAll');

        $export = request('export', []);
        $shouldExport = count($export);

        if ($shouldExport) {
            return (new ExcelExportService($regionalInspections, RegionalInspectionsExport::class, 'liste_des_inspections_régionales.xlsx', $export))->download();
        }

        if ($filter) {
            $regionalInspections = $regionalInspections->filter($filter);
        }

        if ($sort) {
            $regionalInspections = $regionalInspections->sortByMultiple($sort);
        } else {
            $regionalInspections = $regionalInspections->orderBy('code');
        }

        if ($search) {
            $regionalInspections = $regionalInspections->search($search);
        }

        $regionalInspections = $fetchAll ? formatForSelect($regionalInspections->get()->toArray(), 'full_name') : RegionalInspectionResource::collection($regionalInspections->paginate($perPage)->onEachSide(1));
        return $regionalInspections;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Structures\RegionalInspection\StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->validated();
                $dres = $data['dres'];
                unset($data['dres']);
                $ri = RegionalInspection::create($data);
                if (!empty($dres)) {
                    DB::table('dres')->whereIn('id', $dres)->update(['regional_inspection_id' => $ri->id]);
                }
            });
            return response()->json([
                'message' => CREATE_SUCCESS,
                'status' => true
            ]);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param App\Models\Structures\RegionalInspection $regional_inspection
     * @return JsonResponse
     */
    public function show(RegionalInspection $regional_inspection): JsonResponse
    {
        isAbleOrAbort('view_regional_inspection');
        return response()->json($regional_inspection->load('dres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Structures\RegionalInspection\UpdateRequest $request
     * @param App\Models\Structures\RegionalInspection $regional_inspection
     *
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, RegionalInspection $regional_inspection): JsonResponse
    {
        try {
            DB::transaction(function () use ($regional_inspection, $request) {
                $data = $request->validated();
                $dres = $data['dres'];
                unset($data['dres']);
                $removedDre = array_diff($regional_inspection->dres->pluck('id')->toArray(), $dres);
                $addedDre = array_diff($dres, $regional_inspection->dres->pluck('id')->toArray());
                $removedAgencies = Dre::whereIn('id', $removedDre)->with('agencies')->get()->pluck('agencies')->flatten()->pluck('id')->toArray();
                $addedAgencies = Dre::whereIn('id', $addedDre)->with('agencies')->get()->pluck('agencies')->flatten()->pluck('id')->toArray();
                $regional_inspection->update($data);
                DB::table('dres')->where('regional_inspection_id', $regional_inspection->id)->update(['regional_inspection_id' => NULL]);
                $regionalInspectors = User::whereRoles(['ir'])->whereRelation('regional_inspections', 'regional_inspections.id', $regional_inspection->id)->get();
                dd($regionalInspectors, $regional_inspection->id);
                foreach ($regionalInspectors as $ri) {
                    dd($ri->id, $addedAgencies);
                    DB::table('user_has_agencies')->where('user_id', $ri->id)->whereIn('agency_id', $removedAgencies)->delete();
                    foreach ($addedAgencies as $agency) {
                        DB::table('user_has_agencies')->insert(['user_id' => $ri->id, 'agency_id' => $agency]);
                    }
                }
                if (!empty($dres)) {
                    DB::table('dres')->whereIn('id', $dres)->update(['regional_inspection_id' => $regional_inspection->id]);
                }
            });
            return response()->json([
                'message' => UPDATE_SUCCESS,
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\Structures\RegionalInspection $regional_inspection
     * @return JsonResponse
     */
    public function destroy(RegionalInspection $regional_inspection): JsonResponse
    {
        isAbleOrAbort('delete_regional_inspection');

        try {
            return actionResponse($regional_inspection->delete(), DELETE_SUCCESS);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }
}
