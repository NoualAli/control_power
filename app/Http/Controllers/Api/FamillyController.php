<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Familly\StoreRequest;
use App\Http\Requests\Familly\UpdateRequest;
use App\Http\Resources\FamillyResource;
use App\Models\Domain;
use App\Models\Familly;
use Illuminate\Http\JsonResponse;

class FamillyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $famillies = new Familly();

        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request()->has('fetchAll');
        $withChildren = boolVal(request('withChildren', false));

        if ($filter) {
            $famillies = $famillies->filter($filter);
        }

        if ($sort) {
            $famillies = $famillies->sortByMultiple($sort);
        }
        if ($search) {
            $famillies = $famillies->search($search);
        }

        if ($fetchAll && $withChildren) {
            $famillies = getPCF();
        } elseif ($fetchAll && !$withChildren) {
            $famillies = formatForSelect($famillies->get()->toArray());
        }
        $famillies = $fetchAll ? $famillies : FamillyResource::collection($famillies->paginate($perPage)->onEachSide(1));
        return $famillies;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Familly\StoreRequest  $request*
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $familly = Familly::create($data);

            return response()->json([
                'message' => CREATE_SUCCESS,
                'status' => true
            ]);
        } catch (\Throwable $th) {
            $code = $th->getCode() ?: 500;

            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], $code);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param string $familly
     * @return JsonResponse
     */
    public function show(string $familly): JsonResponse
    {
        $famillies = explode(',', $familly);
        $onlyDomains = request()->has('onlyDomains');
        $data = !$onlyDomains ? Familly::findOrFail($familly) : formatForSelect(Domain::whereIn('familly_id', $famillies)->get()->toArray());
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Familly\UpdateRequest $request
     * @param App\Models\Familly $familly
     *
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Familly $familly): JsonResponse
    {
        try {
            $data = $request->validated();
            $familly->update($data);
            return response()->json([
                'message' => UPDATE_SUCCESS,
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            $code = $th->getCode() ?: 500;

            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], $code);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\Familly $familly
     * @return JsonResponse
     */
    public function destroy(Familly $familly): JsonResponse
    {
        isAbleOrAbort('delete_familly');
        try {
            $familly->delete();
            return response()->json([
                'message' => DELETE_SUCCESS,
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            $code = $th->getCode() ?: 500;

            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], $code);
        }
    }
}
