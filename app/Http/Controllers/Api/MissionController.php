<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\AssignToCCRequest;
use App\Http\Requests\Mission\StoreRequest;
use App\Http\Requests\Mission\UpdateRequest;
use App\Http\Resources\MissionProcessesResource;
use App\Http\Resources\MissionResource;
use App\Models\Agency;
use App\Models\ControlCampaign;
use App\Models\Familly;
use App\Models\Mission;
use App\Models\User;
use App\Notifications\MissionAssignedNotification;
use App\Notifications\MissionCreatedNotification;
use App\Notifications\MissionValidatedNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

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
            $missions = $this->getMissions();

            if (request()->has('campaign_id')) {
                $missions = $missions->where('control_campaign_id', request()->campaign_id);
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
            } elseif (request()->has('export')) {
                $missions = MissionResource::collection($missions->paginate(10)->onEachSide(1));
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

    private function getMissions()
    {
        $missions = new Mission;
        if (hasRole(['dcp', 'cdcr'])) {
            $missions = $missions->validated();
        } elseif (hasRole(['cdc', 'cc', 'ci'])) {
            $missions = auth()->user()->missions();
        } elseif (hasRole(['da', 'dre'])) {
            $missions = auth()->user()->missions()->hasDcpValidation();
        } elseif (hasRole(['dg', 'cdrcp', 'der'])) {
            $missions = $missions->hasDcpValidation();
        }
        return $missions;
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
        $currentUser = auth()->user();
        // dd($mission->agencyControllers->pluck('id')->toArray());
        $condition = (in_array($currentUser->id, $mission->agencyControllers->pluck('id')->toArray())
            || in_array($currentUser->id, $mission->dcpControllers->pluck('id')->toArray())
            || $mission->created_by_id == $currentUser->id
            || (hasRole(['dcp', 'cdcr']) && $mission->dre_report?->is_validated)
            || (hasRole(['da', 'dg', 'cdrcp', 'ig', 'der']) && $mission->dcp_validation_at)
            || hasRole('dre') && in_array($mission->agency->id, $currentUser->agencies->pluck('id')->toArray())
        );
        abort_if(!$condition, 401, __('unauthorized'));
        if (request()->has('edit')) {
            $condition = $mission->remaining_days_before_start > 5;
            abort_if(!$condition, 401, __('unauthorized'));
        }
        if (request()->has('onlyProcesses') || request()->has('page')) {
            // dd($mission->processes);
            $processes = $mission->details->pluck('process')->unique('id')->values()->sortBy('familly.id');
            $search = request()->has('search') ? request()->search : false;
            if ($search) {
                $processes = $processes->filter(fn ($processe) => preg_match('/' . strtolower($search) . '/', strtolower($processe->name)));
            }
            return MissionProcessesResource::collection(paginate($processes, '/api/missions/' . $mission->id));
        }
        $mission = $mission->load(['agency', 'dre', 'agencyControllers', 'dcpControllers', 'campaign' => fn ($campaign) => $campaign->without('processes')])->unsetRelation('reports');
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
        $dres = $user->agencies;
        $currentCampaign = request()->has('campaign_id') ? ControlCampaign::findOrFail(request()->campaign_id) : ControlCampaign::current();
        $missions = $currentCampaign->missions;
        $campaigns = formatForSelect(ControlCampaign::orderBy('reference', 'DESC')->get()->toArray(), 'reference');
        $controllers = formatForSelect((clone $dres)->pluck('users')->flatten()->filter(function ($user) use ($missions) {
            return $user->isAbleTo('control_agency');
            // && $user->id !== auth()->user()->id;
            // && !in_array($user->id, $missions->pluck('controllers')->flatten()->pluck('id')->toArray())
        })->unique('id')->toArray(), 'full_name');
        $agencies = formatForSelect(($user->dres)->pluck('agencies')->flatten()->filter(function ($agency) use ($missions) {
            return !in_array($agency?->id, $missions->pluck('agency')->flatten()->pluck('id')->toArray());
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
                    $mission->agencyControllers()->attach($data['controllers']);
                    $mission->details()->createMany($controlPoints);
                    foreach ($mission->agencyControllers as $controller) {
                        Notification::send($controller, new MissionCreatedNotification($mission));
                        // $controller->notify(new MissionCreatedNotification($mission, $controller));
                    }
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

    public function validateMission(Mission $mission, int $step)
    {
        $isAbleOrAbort = $step == 1 ? 'make_first_validation' : 'make_second_validation';
        $cond = $step == 1 ? $mission->cdcr_validation_at : $mission->dcp_validation_at;
        isAbleOrAbort($isAbleOrAbort);
        abort_if($cond, 403);
        try {
            $res = DB::transaction(function () use ($mission, $step) {
                $validator = auth()->user()->id;
                $time = now();
                $validationAtColumn = 'dcp_validation_at';
                $validatedByIdColumn = 'dcp_valited_by_id';
                // $users = User::all()->filter(fn ($user) => hasRole(['cdcr', 'dg', 'cdcrp'], $user));
                $users = User::whereRoles(['cdcr', 'dg', 'cdcrp']);
                if ($step == 1) {
                    $validationAtColumn = 'cdcr_validation_at';
                    $validatedByIdColumn = 'cdcr_valited_by_id';
                    $users = User::dcp();
                }
                $res = $mission->update([
                    $validatedByIdColumn => $validator,
                    $validationAtColumn => $time
                ]);
                if ($res) {
                    foreach ($users as $user) {
                        Notification::send($user, new MissionValidatedNotification($mission));
                    }
                }
                return $res;
            });
            if ($res) {
                return response()->json([
                    'message' => MISSION_VALIDATION_SUCCESS,
                    'status' => true,
                ]);
            }
            return response()->json([
                'message' => MISSION_VALIDATION_ERROR,
                'status' => false,
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
                $mission->agencyControllers()->sync($data['controllers']);
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

    public function assignToCC(AssignToCCRequest $request, Mission $mission)
    {
        try {
            DB::transaction(function () use ($request, $mission) {

                $mission->dcpControllers()->syncWithPivotValues($request->controllers, ['control_agency' => false]);
                $controllers = User::whereIn('id', $request->controllers)->get();
                foreach ($controllers as $controller) {
                    Notification::send($controller, new MissionAssignedNotification($mission));
                }
            });
            return response()->json([
                'message' => UPDATE_SUCCESS,
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false,
            ], 500);
        }
    }
}
