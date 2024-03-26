<?php

namespace App\Http\Controllers\Api\Structures;

use App\Exports\DresExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Structures\Dre\StoreRequest;
use App\Http\Requests\Structures\Dre\UpdateRequest;
use App\Http\Resources\Structures\DreResource;
use App\Models\Structures\Dre;
use App\Services\ExcelExportService;
use Illuminate\Http\JsonResponse;

class DreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        isAbleOrAbort(['view_dre', 'create_user', 'update_user']);
        $dres = Dre::withCount('agencies');

        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request()->has('fetchAll');

        $export = request('export', []);
        $shouldExport = count($export);

        if ($shouldExport) {
            return (new ExcelExportService($dres, DresExport::class, 'liste_des_dre.xlsx', $export))->download();
        }

        if ($filter) {
            $dres = $dres->filter($filter);
        }

        if ($sort) {
            $dres = $dres->sortByMultiple($sort);
        } else {
            $dres = $dres->orderBy('code');
        }

        if ($search) {
            $dres = $dres->search($search);
        }

        if ($fetchAll) {
            $dres = formatForSelect($dres->get()->toArray(), 'full_name');
        } else {
            $dres = DreResource::collection($dres->paginate($perPage)->onEachSide(1));
        }

        if (request()->has('withAgencies')) {
            $dres = $this->loadWithAgencies();
        }
        return $dres;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Structures\Dre\StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $dre = Dre::create($data);

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
     * @param App\Models\Structures\Dre $dre
     * @return JsonResponse
     */
    public function show(Dre $dre): JsonResponse
    {
        isAbleOrAbort('view_dre');
        return response()->json($dre);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Structures\Dre\UpdateRequest $request
     * @param App\Models\Structures\Dre $dre
     *
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Dre $dre): JsonResponse
    {
        try {
            $data = $request->validated();
            $dre->update($data);
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
     * @param App\Models\Structures\Dre $dre
     * @return JsonResponse
     */
    public function destroy(Dre $dre): JsonResponse
    {
        isAbleOrAbort('delete_dre');

        try {
            return actionResponse($dre->delete(), DELETE_SUCCESS);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    private function loadWithAgencies()
    {
        $dre = Dre::orderBy('id', 'ASC')->with('agencies')->get()->toArray();
        $dre = array_map(function ($dre) {
            return [
                'id' => 'd-' . $dre['id'],
                'label' => $dre['full_name'],
                'children' => array_map(function ($agency) {
                    return [
                        'id' => $agency['id'],
                        'label' => $agency['full_name'],
                    ];
                }, $dre['agencies'])
            ];
        }, $dre);

        return $dre;
    }
}
