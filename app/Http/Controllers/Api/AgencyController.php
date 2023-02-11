<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Agency\StoreRequest;
use App\Http\Requests\Agency\UpdateRequest;
use App\Http\Resources\AgencyResource;
use App\Models\Agency;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        $agencies = new Agency();

        $search = request()->has('search') && !empty(request()->search) ? request()->search : null;
        $order = request()->has('order') && !empty(request()->order) ? request()->order : null;
        $filter = request()->has('filter') ? request()->filter : null;

        if ($filter) {
            $agencies = $agencies->filter($filter);
        }

        if ($order) {
            $agencies = $agencies->orderByMultiple($order);
        }
        if ($search) {
            $agencies = $agencies->search($search);
        }
        $perPage = request()->has('perPage') && !empty(request()->perPage) && request()->perPage !== 'undefined' ? request()->perPage : 10;
        $agencies = request()->has('fetchAll') ? $agencies->get()->toJson() : AgencyResource::collection($agencies->paginate($perPage)->onEachSide(1));
        return $agencies;
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
            $agency = Agency::create($data);

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
            $agency->update($data);
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
            $code = $th->getCode() ?: 500;

            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], $code);
        }
    }
}