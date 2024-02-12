<?php

namespace App\Http\Controllers\Api\V1;

use App\Exports\BugExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Bug\StoreRequest;
use App\Http\Resources\BugResource;
use App\Models\Bug;
use App\Models\User;
use App\Notifications\BugDetected;
use App\Notifications\BugFixed;
use App\Services\ExcelExportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

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
        $export = request('export', []);
        $shouldExport = count($export);

        if (hasRole(['root', 'admin'])) {
            $bugs = Bug::with('creator');
        } else {
            $bugs = auth()->user()->bugs();
        }

        if ($shouldExport) {
            return (new ExcelExportService($bugs, BugExport::class, 'bugs.xlsx', $export))->download();
        }

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
            $bug = DB::transaction(function () use ($request) {
                $data = $request->validated();
                $data['created_by_id'] = auth()->user()->id;
                $media = $data['media'];
                unset($data['media']);
                $bug = Bug::create($data);
                foreach ($media as $id) {
                    $media = DB::table('has_media')->updateOrInsert([
                        'attachable_id' => $bug->id,
                        'attachable_type' => Bug::class,
                        'media_id' => $id,
                    ]);
                }
                return $bug;
            });
            if ($bug->wasRecentlyCreated) {
                $users = User::whereRoles(['root', 'admin'])->get();
                foreach ($users as $user) {
                    Notification::send($user, new BugDetected($bug));
                }
            }
            $errorMessage = 'Une erreur est survenu lors de l\'enregistrement de votre message.';
            $successMessage = 'Votre bug a été rapporté et sera réglé très prochainement.';
            return actionResponse($bug->wasRecentlyCreated, $successMessage, $errorMessage);
        } catch (\Throwable $th) {
            return throwedError($th);
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
     * Mark as resolved the specified resource in storage.
     *
     * @param  \App\Models\Bug  $bug
     * @return \Illuminate\Http\Response
     */
    public function resolve(Bug $bug)
    {
        try {
            $result = $bug->update(['fixed_at' => now()]);
            if ($result) {
                Notification::send($bug->creator, new BugFixed($bug));
            }
            return actionResponse($result, UPDATE_SUCCESS);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
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
