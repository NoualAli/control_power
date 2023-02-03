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
        $dres = new Dre();
        $search = request()->has('search') && !empty(request()->search) ? request()->search : null;
        $order = request()->has('order') && !empty(request()->order) ? request()->order : null;

        if ($order) {
            $dres = $dres->orderByMultiple($order);
        }
        if ($search) {
            $dres = $dres->search($search);
        }
        $dres = request()->has('fetchAll') ? $dres->get()->toJson() : DreResource::collection($dres->paginate()->onEachSide(1));
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
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ]);
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
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ]);
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
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ]);
        }
    }
}