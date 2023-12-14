<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Agency\StoreRequest;
use App\Http\Requests\Agency\UpdateRequest;
use App\Http\Resources\AgencyResource;
use App\Models\Agency;
use App\Models\Category;
use App\Models\Dre;
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
        $agencies = Agency::with(['category', 'dre']);

        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request()->has('fetchAll');

        if ($filter) {
            $agencies = $agencies->filter($filter);
        }

        if ($sort) {
            $agencies = $agencies->sortByMultiple($sort);
        } else {
            $agencies = $agencies->orderBy('code');
        }

        if ($search) {
            $agencies = $agencies->search($search);
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
     * @param  App\Http\Agency\StoreRequest  $request*
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
     * @param App\Models\Agency $agency
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
     * @param App\Http\Agency\UpdateRequest $request
     * @param App\Models\Agency $agency
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
     * @param App\Models\Agency $agency
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
}
