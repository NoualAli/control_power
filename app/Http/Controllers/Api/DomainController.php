<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Domains\StoreRequest;
use App\Http\Requests\Domains\UpdateRequest;
use App\Http\Resources\DomainResource;
use App\Models\Domain;
use App\Models\Process;
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
        $domains = Domain::with('family')->withCount('processes');

        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request()->has('fetchAll');

        if ($filter) {
            $domains = $domains->filter($filter);
        }

        if ($sort) {
            $domains = $domains->sortByMultiple($sort);
        }
        if ($search) {
            $domains = $domains->search($search);
        }

        $domains = $fetchAll ? $domains->get()->toJson() : DomainResource::collection($domains->paginate($perPage)->onEachSide(1));
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
     * @param string $domain
     * @return JsonResponse
     */
    public function show(string $domain): JsonResponse
    {
        $domains = explode(',', $domain);
        $onlyProcesses = request()->has('onlyProcesses');
        $data = $onlyProcesses ? formatForSelect(Process::whereIn('domain_id', $domains)->get()->toArray()) : Domain::findOrFail($domain)->load('family');
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
            $code = $th->getCode() ?: 500;

            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], $code);
        }
    }
}
