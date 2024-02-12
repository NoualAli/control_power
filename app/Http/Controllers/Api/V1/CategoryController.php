<?php

namespace App\Http\Controllers\Api\V1;

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
        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request()->has('fetchAll');

        $categories = Category::withCount('processes');


        if ($filter) {
            $categories = $categories->filter($filter);
        }

        if ($sort) {
            $categories = $categories->sortByMultiple($sort);
        }
        if ($search) {
            $categories = $categories->search($search);
        }

        $categories = $fetchAll ? $categories->get()->toJson() : CategoryResource::collection($categories->paginate($perPage)->onEachSide(1));
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
            return throwedError($th);
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
            return throwedError($th);
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
            return throwedError($th);
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
        return Process::whereHas('family', function ($query) use ($families) {
            return $query->whereIn('families.id', $families);
        })->get();
    }
}
