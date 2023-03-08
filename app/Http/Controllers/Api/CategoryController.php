<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Process;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        isAbleOrAbort(['view_category']);
        $categories = Category::withCount('processes');

        $search = request()->has('search') && !empty(request()->search) ? request()->search : null;
        $order = request()->has('order') && !empty(request()->order) ? request()->order : null;
        $filter = request()->has('filter') ? request()->filter : null;

        if ($filter) {
            $categories = $categories->filter($filter);
        }

        if ($order) {
            $categories = $categories->orderByMultiple($order);
        }
        if ($search) {
            $categories = $categories->search($search);
        }
        $perPage = request()->has('perPage') && !empty(request()->perPage) && request()->perPage !== 'undefined' ? request()->perPage : 10;
        $categories = request()->has('fetchAll') ? $categories->get()->toJson() : CategoryResource::collection($categories->paginate($perPage)->onEachSide(1));
        return $categories;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Category\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $data = $request->validated();
            DB::transaction(function () use ($data) {
                $processes = pcfToProcesses($data['pcf']);
                unset($data['pcf']);
                $category = Category::create($data);
                $category->processes()->sync($processes);
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

    public function config()
    {
        $pcf = getPCF();
        $category = request()->has('category_id') && !empty(request()->category_id) ? Category::findOrFail(request()->category_id)->only(['id', 'name', 'processes']) : null;
        return $category ? compact('category', 'pcf') : compact('pcf');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        isAbleOrAbort('view_agency');
        $category->load('processes');
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Category\UpdateRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Category $category)
    {
        try {
            $data = $request->validated();
            DB::transaction(function () use ($data, $category) {
                $processes = pcfToProcesses($data['pcf']);
                unset($data['pcf']);
                $category->update($data);
                $category->processes()->sync($processes);
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        isAbleOrAbort('delete_category');
        try {
            $category->delete();
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
