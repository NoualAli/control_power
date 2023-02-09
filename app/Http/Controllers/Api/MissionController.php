<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\StoreRequest;
use App\Http\Requests\Mission\UpdateRequest;
use App\Http\Resources\MissionProcessesResource;
use App\Http\Resources\MissionResource;
use App\Models\Agency;
use App\Models\ControlCampaign;
use App\Models\Mission;
use Illuminate\Support\Facades\DB;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        isAbleOrAbort(['view_mission']);
        try {
            $missions = hasRole(['dcp', 'dg', 'div']) ? (new Mission) : auth()->user()->missions();

            if (request()->has('campaign_id')) {
                $missions = $missions->where('control_campaign_id', request()->campaign_id);
            } else {
                // $missions = $missions->validated();
            }
            if (request()->has('order')) {
                $missions = $missions->orderByMultiple(request()->order);
            } else {
                $missions = $missions->orderBy('created_at', 'DESC');
            }

            $search = request()->has('search') && !empty(request()->search) ? request()->search : false;
            if ($search) {
                $missions = $missions->search($search);
            }

            $filter = request()->has('filter') ? request()->filter : null;
            if ($filter) {
                $missions = $missions->filter($filter);
            }

            if (request()->has('fetchAll')) {
                $missions = $missions->get()->pluck('reference', 'id');
            } else {
                $missions = MissionResource::collection($missions->paginate(10)->onEachSide(1));
            }
            return $missions;
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
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function show(Mission $mission)
    {
        isAbleOrAbort('view_mission');
        $condition = (in_array(auth()->user()->id, $mission->controllers->pluck('id')->toArray()) || $mission->created_by_id == auth()->user()->id || hasRole(['dcp', 'dg']));
        abort_if(!$condition, 401, __('unauthorized'));
        if (request()->has('edit')) {
            $condition = $mission->remaining_days_before_start > 5;
            abort_if(!$condition, 401, __('unauthorized'));
        }
        if (request()->has('onlyProcesses') || request()->has('page')) {
            $processes = $mission->details->pluck('process')->unique('id')->values()->sortBy('familly.id');
            return MissionProcessesResource::collection(paginate($processes, '/api/missions/' . $mission->id));
        }
        $mission = $mission->load(['agency', 'dre', 'controllers', 'campaign' => fn ($campaign) => $campaign->without('processes')])->unsetRelation('reports');
        return $mission;
    }

    /**
     * Display config.
     *
     * @return \Illuminate\Http\Response
     */
    public function config()
    {
        isAbleOrAbort(['create_missions', 'edit_mission']);
        $user = auth()->user();
        $dres = $user->dres;
        $currentCampaign = request()->has('campaign_id') ? ControlCampaign::findOrFail(request()->campaign_id) : ControlCampaign::current();
        $missions = $currentCampaign->missions;
        $campaigns = formatForSelect(ControlCampaign::orderBy('reference', 'DESC')->get()->toArray(), 'reference');
        $controllers = formatForSelect((clone $dres)->pluck('users')->flatten()->filter(function ($user) use ($missions) {
            return $user->isAbleTo('control_agency');
            // && $user->id !== auth()->user()->id;
            // && !in_array($user->id, $missions->pluck('controllers')->flatten()->pluck('id')->toArray())
        })->toArray(), 'full_name');
        $agencies = formatForSelect((clone $dres)->pluck('agencies')->flatten()->filter(function ($agency) use ($missions) {
            return !in_array($agency->id, $missions->pluck('agency')->flatten()->pluck('id')->toArray());
        })->toArray(), 'full_name');
        return compact('agencies', 'campaigns', 'controllers', 'currentCampaign');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['created_by_id'] = auth()->user()->id;

        try {
            $campaign = ControlCampaign::findOrFail($data['control_campaign_id']);
            $processes = $campaign->processes;
            $controlPoints = $processes->pluck('control_points')->flatten()->map(fn ($controlPoint) => ['control_point_id' => $controlPoint->id]);
            foreach ($data['agencies'] as $agency) {
                $agency = Agency::findOrFail($agency);
                DB::transaction(function () use ($data, $agency, $campaign, $controlPoints) {
                    $reference = 'RAP' . str_replace('-', '', str_replace('CDC-', '', $campaign->reference)) . '/' . $agency->code;
                    $mission = Mission::create([
                        'reference' => $reference,
                        'control_campaign_id' => $campaign->id,
                        'agency_id' => $agency->id,
                        'created_by_id' => auth()->user()->id,
                        'start' => $data['start'],
                        'end' => $data['end'],
                        'note' => $data['note'],
                    ]);
                    $mission->controllers()->attach($data['controllers']);
                    $mission->details()->createMany($controlPoints);
                });
            }

            return response()->json([
                'message' => CREATE_SUCCESS,
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            $status = false;
            return response()->json(compact('message', 'status'));
        }
    }

    /**
     * Update the specified resource in storage
     *
     * @param UpdateRequest $request
     * @param Mission $mission
     *
     * @return Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Mission $mission)
    {
        $data = $request->validated();

        try {
            DB::transaction(function () use ($mission, $data) {
                $mission->controllers()->sync($data['controllers']);
                $mission = $mission->update([
                    'start' => $data['start'],
                    'end' => $data['end'],
                    'note' => $data['note'],
                ]);
            });

            return response()->json([
                'message' => UPDATE_SUCCESS,
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            $status = false;
            return response()->json(compact('message', 'status'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mission $mission)
    {
        isAbleOrAbort('delete_mission');
        try {
            if ($mission->delete()) {
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
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false,
            ]);
        }
    }
}
