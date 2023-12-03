<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Field\StoreRequest;
use App\Http\Requests\Field\UpdateRequest;
use App\Http\Resources\FieldResource;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        isAbleOrAbort(['view_fields', 'view_control_point']);
        $fields = Field::query();

        $search = request('search', null);
        $sort = request('sort', null);
        $filter = request('filter', null);
        $fetchFilters = request()->has('fetchFilters');
        $fetchAll = request()->has('fetchAll');
        if ($fetchFilters) {
            return $this->filters();
        }
        if ($filter) {
            $fields = $fields->filter($filter);
        }

        if ($sort) {
            $fields = $fields->sortByMultiple($sort);
        }
        if ($search) {
            $fields = $fields->search(['label', 'name'], $search);
        }

        $perPage = request('perPage', 10);

        $fields = $fetchAll ? formatForSelect($fields->get()->toArray(), 'label') : FieldResource::collection($fields->paginate($perPage)->onEachSide(1));
        return $fields;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Field\StoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['options'] = isset($data['options']) && count($data['options']) ? implode(',', $data['options']) : null;
        $data['additional_rules'] = isset($data['additional_rules']) && count($data['additional_rules']) ? implode(',', $data['additional_rules']) : null;
        $data['min_length'] = isset($data['min_length']) && !is_null($data['min_length']) ? $data['min_length'] : 0;
        $data['columns'] = isset($data['columns']) && !is_null($data['columns']) ? $data['columns'] : 12;

        try {
            $field = DB::transaction(function () use ($data) {
                return Field::create($data);
            });
            return response()->json([
                'message' => CREATE_SUCCESS,
                'status' => true,
            ], SERVER_SUCCESS);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => env('production') || env('production-test') ? DEFAULT_ERROR_MESSAGE : $th->getMessage(),
                'status' => true,
            ], SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function show(Field $field)
    {
        isAbleOrAbort('view_fields');
        return response()->json($field);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Field\UpdateRequest  $request
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, Field $field)
    {
        $data = $request->validated();
        $data['options'] = isset($data['options']) && count($data['options']) ? implode(',', $data['options']) : null;
        $data['additional_rules'] = isset($data['additional_rules']) && count($data['additional_rules']) ? implode(',', $data['additional_rules']) : null;
        $data['min_length'] = isset($data['min_length']) && !is_null($data['min_length']) ? $data['min_length'] : 0;
        $data['columns'] = isset($data['columns']) && !is_null($data['columns']) ? $data['columns'] : 12;

        try {
            $result = DB::transaction(function () use ($field, $data) {
                return $field->update($data);
            });
            return response()->json([
                'message' => $result ? UPDATE_SUCCESS : UPDATE_ERROR,
                'status' => $result,
            ], SERVER_SUCCESS);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => env('production') || env('production-test') ? DEFAULT_ERROR_MESSAGE : $th->getMessage(),
                'status' => true,
            ], SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function destroy(Field $field)
    {
        isAbleOrAbort('edit_field');

        try {
            $result = $field->delete();
            return response()->json([
                'message' => $result ? DELETE_SUCCESS : DELETE_ERROR,
                'status' => $result,
            ], SERVER_SUCCESS);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => env('production') || env('production-test') ? DEFAULT_ERROR_MESSAGE : $th->getMessage(),
                'status' => true,
            ], SERVER_ERROR);
        }
    }
}
