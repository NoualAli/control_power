<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Family\StoreRequest;
use App\Http\Requests\Family\UpdateRequest;
use App\Http\Resources\FamilyResource;
use App\Models\Domain;
use App\Models\Family;
use Illuminate\Http\JsonResponse;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $families = Family::withCount('domains');
        // $families = new Family();

        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request()->has('fetchAll');
        $withChildren = request()->has('withChildren');

        if ($filter) {
            $families = $families->filter($filter);
        }

        if ($sort) {
            $families = $families->sortByMultiple($sort);
        }
        if ($search) {
            $families = $families->search($search);
        }

        if ($fetchAll && $withChildren) {
            $families = getPCF();
        } elseif ($fetchAll && !$withChildren) {
            $families = formatForSelect($families->get()->toArray());
        }
        $families = $fetchAll ? $families : FamilyResource::collection($families->paginate($perPage)->onEachSide(1));
        return $families;
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
            $data = $request->validated();
            $family = Family::create($data);

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
     * @param string $family
     * @return JsonResponse
     */
    public function show(string $family): JsonResponse
    {
        $families = explode(',', $family);
        $onlyDomains = request()->has('onlyDomains');
        $data = !$onlyDomains ? Family::findOrFail($family) : formatForSelect(Domain::whereIn('family_id', $families)->get()->toArray());
        return response()->json($data);
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
            $data = $request->validated();
            $family->update($data);
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
     * @param App\Models\Family $family
     * @return JsonResponse
     */
    public function destroy(Family $family): JsonResponse
    {
        isAbleOrAbort('delete_familly');
        try {
            $family->delete();
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
