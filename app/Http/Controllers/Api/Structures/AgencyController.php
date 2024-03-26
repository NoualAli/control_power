<?php

namespace App\Http\Controllers\Api\Structures;

use App\Exports\AgenciesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Structures\Agency\StoreRequest;
use App\Http\Requests\Structures\Agency\UpdateRequest;
use App\Http\Resources\Structures\AgencyResource;
use App\Models\Structures\Agency;
use App\Models\Structures\Category;
use App\Models\Structures\Dre;
use App\Services\ExcelExportService;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        isAbleOrAbort(['view_agency', 'create_dre', 'update_dre']);
        $agencies = DB::table('agencies as a')
            ->select(['a.id', 'a.name', 'a.code', DB::raw("CONCAT(d.code, ' - ', d.name) as dre"), 'c.name as category'])
            ->leftJoin('dres as d', 'd.id', 'a.dre_id')
            ->leftJoin('categories as c', 'c.id', 'a.category_id');

        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request()->has('fetchAll');

        $export = request('export', []);
        $shouldExport = count($export);
        if ($shouldExport) {
            $export['search_columns'] = ['a.name', 'a.code'];
        }

        if ($fetchFilters) {
            return $this->filters();
        }

        if ($shouldExport) {
            return (new ExcelExportService($agencies, AgenciesExport::class, 'liste_des_agences.xlsx', $export))->download();
        }

        if ($sort) {
            $agencies = $agencies->sortByMultiple($sort);
        } else {
            $agencies = $agencies->orderBy('code');
        }

        if ($filter) {
            $agencies = $this->filter($agencies, $filter);
        }


        if ($search) {
            $agencies = $agencies->search(['a.name', 'a.code'], $search);
        }

        $agencies = $fetchAll ? formatForSelect($agencies->get()->toArray(), 'full_name') : AgencyResource::collection($agencies->paginate($perPage)->onEachSide(1));
        return $agencies;
    }

    public function config()
    {
        $categories = formatForSelect(Category::without('processes')->select(['id', 'name'])->get()->toArray());
        $dres = formatForSelect(Dre::without('agencies')->get()->toArray(), 'full_name');
        // $dres = Dre::without('agencies')->get()->toArray();
        $pcf = getPCF();
        $agency = request('agency_id', null) ? Agency::findOrFail(intval(request()->agency_id))->load(['usableProcesses', 'unusableProcesses'])->only('id', 'name', 'code', 'category_id', 'dre_id', 'usableProcesses', 'unusableProcesses') : null;
        return $agency ? compact('dres', 'categories', 'agency', 'pcf') : compact('dres', 'categories', 'pcf');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Structures\StoreRequest  $request*
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            DB::transaction(function () use ($data) {
                $pcfUsable = pcfToProcesses($data['pcf_usable']);
                $pcfUnusable = pcfToProcesses($data['pcf_unusable']);
                unset($data['pcf_usable'], $data['pcf_unusable']);
                $agency = Agency::create($data);
                if ($agency->id) {
                    if (!empty($pcfUnusable)) {
                        $agency->processes()->attach($pcfUsable, ['is_usable' => true]);
                    }

                    if (!empty($pcfUsable)) {
                        $agency->processes()->attach($pcfUnusable, ['is_usable' => false]);
                    }
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
     * @param App\Models\Structures\Agency $agency
     * @return JsonResponse
     */
    public function show(Agency $agency): JsonResponse
    {
        isAbleOrAbort('view_agency');
        $agency->load('dre');
        return response()->json($agency);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Structures\UpdateRequest $request
     * @param App\Models\Structures\Agency $agency
     *
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Agency $agency): JsonResponse
    {
        try {
            $data = $request->validated();
            DB::transaction(function () use ($data, $agency) {
                $pcfUsable = pcfToProcesses($data['pcf_usable']);
                $pcfUnusable = pcfToProcesses($data['pcf_unusable']);
                unset($data['pcf_usable'], $data['pcf_unusable']);

                $agency->update($data);

                $agency->usableProcesses()->detach();
                if (count($pcfUsable)) $agency->usableProcesses()->attach($pcfUsable, ['is_usable' => true]);

                $agency->unusableProcesses()->detach();
                if (count($pcfUnusable)) $agency->unusableProcesses()->attach($pcfUnusable, ['is_usable' => false]);
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
     * @param App\Models\Structures\Agency $agency
     * @return JsonResponse
     */
    public function destroy(Agency $agency): JsonResponse
    {
        isAbleOrAbort('delete_agency');
        try {
            $agency->delete();
            return response()->json([
                'message' => DELETE_SUCCESS,
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    /**
     * Fetch filters data
     * @return array
     */
    private function filters()
    {
        $dres = DB::table('dres as d')
            ->select(DB::raw("CONCAT(d.code, ' - ', d.name) as name"), 'd.id')
            ->rightJoin('agencies as a', 'd.id', 'a.dre_id')->groupBy('d.id', 'd.code', 'd.name')->get()->toArray();
        $dres = formatForSelect($dres);

        $categories = DB::table('categories as c')
            ->select('c.name', 'c.id')
            ->rightJoin('agencies as a', 'c.id', 'a.category_id')->groupBy('c.id', 'c.name')->get()->toArray();
        $categories = formatForSelect($categories);

        return compact('dres', 'categories');
    }

    /**
     * Filter data
     * @param Builder $agencies
     * @param array $filters
     *
     * @return Builder
     */
    private function filter(Builder $agencies, array $filters): Builder
    {
        if (isset($filters['dres'])) {
            $dres = explode(',', $filters['dres']);
            $agencies = $agencies->whereIn('dre_id', $dres);
        }

        if (isset($filters['categories'])) {
            $categories = explode(',', $filters['categories']);
            $agencies = $agencies->whereIn('category_id', $categories);
        }

        return $agencies;
    }
}
