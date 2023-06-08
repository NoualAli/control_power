<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bug\StoreRequest;
use App\Http\Resources\BugResource;
use App\Models\Bug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);

        // $bugs = Bug::with('creator');
        $bugs = auth()->user()->bugs();
        // dd($bugs);
        if ($fetchFilters) {
            return $this->filters();
        }

        if ($filter) {
            $bugs = $bugs->filter($filter);
        }

        if ($sort) {
            $bugs = $bugs->sortByMultiple($sort);
        } else {
            $bugs = $bugs->orderBy('reference');
        }

        if ($search) {
            $bugs = $bugs->search($search);
        }

        return BugResource::collection($bugs->paginate($perPage)->onEachSide(1));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $res = DB::transaction(function () use ($request) {
                $data = $request->validated();
                $data['created_by_id'] = auth()->user()->id;

                $bug = Bug::create($data);
                // foreach ($request->media as $id) {
                //     $media = Media::findOrFail($id);
                //     $media->attachable_id = $bug->id;
                //     $media->save();
                // }
                return $bug->wasRecentlyCreated;
            });
            $status = $res;
            $message = 'Une erreur est survenu lors de l\'enregistrement de votre message.';
            if ($status) {
                $message = 'Votre bug a été rapporté et sera réglé très prochainement.';
            }
            return response()->json([
                'message' => $message,
                'status' => $status,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bug  $bug
     * @return \Illuminate\Http\Response
     */
    public function show(Bug $bug)
    {
        $bug->load('creator');
        return $bug;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bug  $bug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bug $bug)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bug  $bug
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bug $bug)
    {
        //
    }
}
