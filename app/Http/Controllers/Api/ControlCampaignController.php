<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ControlCampaign\StoreRequest;
use App\Http\Requests\ControlCampaign\UpdateRequest;
use App\Http\Resources\ControlCampaignResource;
use App\Http\Resources\ProcessResource;
use App\Models\ControlCampaign;
use App\Models\Domain;
use App\Models\Familly;
use App\Models\Process;
use DragonCode\Support\Facades\Helpers\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ControlCampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        isAbleOrAbort(['view_control_campaign', 'create_mission', 'edit_mission']);
        $campaigns = new ControlCampaign();

        if (request()->has('order')) {
            foreach (request()->order as $key => $value) {
                $campaigns = $campaigns->orderBy($key, $value);
            }
        } else {
            $campaigns = $campaigns->orderBy('created_at', 'DESC');
        }
        $search = request()->has('search') && !empty(request()->search) ? request()->search : false;
        if ($search) {
            $campaigns = $campaigns->search($search);
        }

        $filter = request()->has('filter') ? request()->filter : null;
        if ($filter) {
            $campaigns = $campaigns->filter($filter);
        }

        if (request()->has('fetchAll')) {
            $campaigns = $campaigns->get()->pluck('reference', 'id');
        } else {
            $perPage = request()->has('perPage') && !empty(request()->perPage) && request()->perPage !== 'undefined' ? request()->perPage : 10;
            $campaigns = ControlCampaignResource::collection($campaigns->paginate($perPage)->onEachSide(1));
        }
        return $campaigns;
    }

    /**
     * Display current campaign
     */
    public function current()
    {
        isAbleOrAbort('view_control_campaign');
        return ControlCampaign::orderBy('created_at', 'ASC')->get()->last();
    }

    /**
     * Get a specific campaign
     */
    public function show(ControlCampaign $campaign)
    {
        isAbleOrAbort('view_control_campaign');
        if (request()->has('edit')) {
            $condition = $campaign->remaining_days_before_start > 5;
            abort_if(!$condition, 401, __('unauthorized'));
        }
        return $campaign;
    }

    /**
     * Get next reference for campaign
     */
    public function getNextReference()
    {
        isAbleOrAbort('create_control_campaign');
        return 'CDC-' . today()->format('Y-') . addZero(ControlCampaign::max('id') + 1);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Requests\ControlCampaign\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $data = $request->validated();
            $pcf = $data['pcf'];
            $pcf = $this->loadProcesses($pcf);
            unset($data['pcf']);

            $user = auth()->user();
            $campaign = DB::transaction(function () use ($user, $data, $pcf) {
                $campaign = $user->campaigns()->create([
                    'description' => $data['description'],
                    'start' => $data['start'],
                    'end' => $data['end'],
                ]);
                foreach ($pcf as $process) {
                    $campaign->processes()->attach($process);
                }

                Artisan::call('campaign:notify', ['id' => $campaign->id, 'created' => true]);
                return $campaign;
            });



            return response()->json([
                'message' => CREATE_SUCCESS,
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\ControlCampaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, ControlCampaign $campaign)
    {
        try {
            $data = $request->validated();
            $pcf = $data['pcf'];
            $pcf = $this->loadProcesses($pcf);
            unset($data['pcf'], $data['reference']);

            DB::transaction(function () use ($campaign, $data, $pcf) {
                if ($campaign->remaining_days_before_start > 5) {
                    $campaign->update($data);
                }
                $campaign->processes()->sync($pcf);
                Artisan::call('campaign:notify', ['id' => $campaign->id, 'created' => false]);
            });


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
     * @param  App\Models\ControlCampaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(ControlCampaign $campaign)
    {
        isAbleOrAbort('delete_control_campaign');
        try {
            if ($campaign->delete()) {
                return response()->json([
                    'message' => DELETE_SUCCESS,
                    'status' => true,
                ]);
            }
            return response()->json([
                'message' => DELETE_ERROR,
                'status' => false,
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
     * Detach the specified resource from control campaign.
     *
     * @param  App\Models\ControlCampaign $campaign
     * @param  App\Models\Process $process
     * @return \Illuminate\Http\Response
     */
    public function destroyProcess(ControlCampaign $campaign, Process $process)
    {
        isAbleOrAbort('delete_control_campaign');
        try {
            if ($campaign->processes()->detach($process)) {
                return response()->json([
                    'message' => DETACH_SUCCESS,
                    'status' => true,
                ]);
            }
            return response()->json([
                'message' => DETACH_ERROR,
                'status' => false,
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
     * Get campaign processes list
     */
    public function processes(ControlCampaign $campaign)
    {
        return ProcessResource::collection($campaign->processes()->paginate(10)->onEachSide(1));
    }

    /**
     * Sanitize PCF array to extract and load only processes ids
     *
     * @param array $data
     *
     * @return array
     */
    private function loadProcesses(array $data)
    {
        $data = Arr::flatten(array_map(function ($item) {
            $item = explode('-', $item);
            $ids = [];
            if ($item[0] == 'd') {
                $ids = array_merge(Domain::findOrFail($item[1])->processes->pluck('id')->toArray(), $ids);
            } elseif ($item[0] == 'f') {
                $ids = array_merge(Familly::findOrFail($item[1])->processes->pluck('id')->toArray(), $ids);
            } else {
                $ids = array_merge($ids, [intval($item[0])]);
            }
            return $ids;
        }, $data));
        $data = Validator::make($data, [
            '*' => 'exists:processes,id'
        ])->validated();

        return $data;
    }
}