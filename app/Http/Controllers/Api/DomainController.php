<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Domains\StoreRequest;
use App\Http\Requests\Domains\UpdateRequest;
use App\Http\Resources\DomainResource;
use App\Http\Resources\ProcessResource;
use App\Models\Domain;
use App\Models\Process;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $domains = new Domain();
        $search = request()->has('search') && !empty(request()->search) ? request()->search : null;
        $order = request()->has('order') && !empty(request()->order) ? request()->order : null;

        if ($order) {
            $domains = $domains->orderByMultiple($order);
        }
        if ($search) {
            $domains = $domains->search($search);
        }
        $domains = request()->has('fetchAll') ? $domains->get()->toJson() : DomainResource::collection($domains->paginate()->onEachSide(1));
        return $domains;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Domain\StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $domain = Domain::create($data);

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
     * @param string $domain
     * @return JsonResponse
     */
    public function show(string $domain): JsonResponse
    {
        $domains = explode(',', $domain);
        $onlyProcesses = request()->has('onlyProcesses');
        $data = $onlyProcesses ? formatForSelect(Process::whereIn('domain_id', $domains)->get()->toArray()) : Domain::findOrFail($domain)->load('familly');
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Domain\UpdateRequest $request
     * @param App\Models\Domain $domain
     *
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Domain $domain): JsonResponse
    {
        try {
            $data = $request->validated();
            $domain->update($data);
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
     * @param App\Models\Domain $domain
     * @return JsonResponse
     */
    public function destroy(Domain $domain): JsonResponse
    {
        isAbleOrAbort('delete_domain');
        try {
            $domain->delete();
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