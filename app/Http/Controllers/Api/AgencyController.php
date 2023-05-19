<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Agency\StoreRequest;
use App\Http\Requests\Agency\UpdateRequest;
use App\Http\Resources\AgencyResource;
use App\Models\Agency;
use App\Models\Category;
use App\Models\Dre;
use App\Models\Familly;
use App\Models\Process;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

        $search = request('search', null);
        $sort = request('sort', null);
        $filter = request('filter', null);

        if ($filter) {
            $agencies = $agencies->filter($filter);
        }

        if ($sort) {
            $agencies = $agencies->sortByMultiple($sort);
        }
        if ($search) {
            $agencies = $agencies->search($search);
        }
        $perPage = request('perPage', false) ? request()->perPage : 10;
        $agencies = request()->has('fetchAll') ? $agencies->get()->toJson() : AgencyResource::collection($agencies->paginate($perPage)->onEachSide(1));
        return $agencies;
    }

    public function config()
    {
        $categories = formatForSelect(Category::select(['id', 'name'])->get()->toArray());
        $dres = Dre::all()->makeHidden('agencies');
        $dres = formatForSelect($dres->toArray(), 'full_name');
        $pcf = getPCF();
        $agency = request()->has('agency_id') && !empty(request()->agency_id) ? Agency::findOrFail(intval(request()->agency_id))->load(['usableProcesses', 'unusableProcesses'])->only('id', 'name', 'code', 'category_id', 'dre_id', 'usableProcesses', 'unusableProcesses') : null;
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
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], 500);
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
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], 500);
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
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], 500);
        }
    }

    /**
     * Sanitize PCF array to extract and load only processes ids
     *
     * @param array $data
     *
     * @return array
     */
    private function loadProcesses($families)
    {
        return Process::whereHas('familly', function ($query) use ($families) {
            return $query->whereIn('famillies.id', $families);
        })->get();
    }
}
