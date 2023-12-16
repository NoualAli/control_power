<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dre\StoreRequest;
use App\Http\Requests\Dre\UpdateRequest;
use App\Http\Resources\DreResource;
use App\Models\Dre;
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

        $dres = $fetchAll ? $dres->get()->toJson() : DreResource::collection($dres->paginate($perPage)->onEachSide(1));
        if (request()->has('withAgencies')) {
            $dres = $this->loadWithAgencies();
        }
        return $dres;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Dre\StoreRequest  $request*
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
     * @param App\Models\Dre $dre
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
     * @param App\Http\Dre\UpdateRequest $request
     * @param App\Models\Dre $dre
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
     * @param App\Models\Dre $dre
     * @return JsonResponse
     */
    public function destroy(Dre $dre): JsonResponse
    {
        isAbleOrAbort('delete_dre');
        try {
            $dre->delete();
            return response()->json([
                'message' => DELETE_SUCCESS,
                'status' => true,
            ]);
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
