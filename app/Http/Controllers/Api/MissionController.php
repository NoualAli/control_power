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
use App\Models\Mission;
use App\Models\User;
use App\Notifications\Mission\AssignationRemoved;
use App\Notifications\Mission\Assigned;
use App\Notifications\Mission\Updated;
use App\Notifications\Mission\Validated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Barryvdh\DomPDF\Facade\Pdf;

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

            $campaignId = request()->has('campaign_id') ? request()->campaign_id : null;
            $campaignId = request()->has('campaignId') ? request()->campaignId : $campaignId;
            if ($campaignId) {
                $missions = $missions->where('control_campaign_id', $campaignId);
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

            $perPage = request()->has('perPage') && !empty(request()->perPage) && request()->perPage !== 'undefined' ? request()->perPage : 10;
            if (request()->has('fetchAll')) {
                $missions = $missions->get()->flatten()('reference', 'id');
            } elseif (request()->has('export')) {
                $missions = MissionResource::collection($missions->paginate($perPage)->onEachSide(1));
            } elseif (request()->has('onlyFilters')) {
                return $this->getFilters($missions);
            } else {
                $missions = MissionResource::collection($missions->paginate($perPage)->onEachSide(1));
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
     * @param mixed $data
     *
     * @return [type]
     */
    public function export(Mission $mission)
    {
        $details = $mission->details()->whereAnomaly()->get()->groupBy('familly.name');
        $campaign = $mission->campaign;
        $pdf = Pdf::loadView('export.report', compact('details', 'mission', 'campaign'));
        // $font = $pdf->getFontMetrics()->get_font("helvetica", "bold");
        // $pdf->getCanvas()->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0, 0, 0));
        return $pdf->stream();
        // return $pdf->download($mission->reference . '.pdf');
    }

    private function getMissions()
    {
        $missions = new Mission();
        if (hasRole(['dcp', 'cdcr', 'dg'])) {
            $missions = $missions;
        } elseif (hasRole(['cdc', 'cc', 'ci'])) {
            $missions = auth()->user()->missions();
        } elseif (hasRole(['da', 'dre'])) {
            $missions = auth()->user()->missions()->hasDcpValidation();
        } elseif (hasRole(['cdrcp', 'der'])) {
            $missions = $missions->hasDcpValidation();
        }
        return $missions;
    }

    public function getFilters($missions = null)
    {
        $missions = $missions ?? $this->getMissions();
        $dre_controllers = $missions->relationUniqueData('agencyControllers', 'full_name', 'id');
        $dres = $missions->relationUniqueData('dre', 'name', 'id', 'full_name');
        $agencies = $missions->relationUniqueData('agency', 'name', 'id', 'full_name');
        $campaigns = $missions->relationUniqueData('campaign', 'reference');
        return compact('dres', 'agencies', 'campaigns', 'dre_controllers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function show(Mission $mission)
    {
        // dd($mission->realisation_state);
        isAbleOrAbort('view_mission');
        $currentUser = auth()->user();
        $agencyControllers = $mission->agencyControllers->pluck('id')->toArray();
        $dcpControllers = $mission->dcpControllers->pluck('id')->toArray();
        $agencies = $currentUser->agencies->pluck('id')->toArray();

        $condition = (in_array($currentUser->id, $agencyControllers)
            || in_array($currentUser->id, $dcpControllers)
            || $mission->created_by_id == $currentUser->id
            || (hasRole(['dcp', 'cdcr']) && $mission->dre_report?->is_validated)
            || (hasRole(['da', 'dg', 'cdrcp', 'ig', 'der']) && $mission->dcp_validation_at)
            || hasRole('dre') && in_array($mission->agency->id, $agencies)
        );
        if (!isAbleTo('view_opinion')) {
            $mission->makeHidden('opinion');
        }
        // if (!isAbleTo('view_dre_report')) {
        //     $mission->makeHidden(['dre_report', 'cdcr_validation_at', 'cdcr_validation_by_id', 'dcp_validation_by_id']);
        // }
        // if (!isAbleTo('view_synthesis')) {
        //     $mission->makeHidden(['synthesis']);
        // }
        abort_if(!$condition, 401, __('unauthorized'));
        if (request()->has('edit')) {
            $condition = $mission->remaining_days_before_start > 5;
            abort_if(!$condition, 401, __('unauthorized'));
        }
        if (request()->has('onlyProcesses') || request()->has('page')) {
            $mission->unsetRelations();
            $processes = DB::table('processes as p');
            if (env('APP_ENV') == 'windows' || env('APP_ENV') == 'testServer') {
                $processes = $processes->selectRaw("p.id as process_id, p.name as process, d.name as domain, f.name as family, COUNT(cp.id) as control_points_count, AVG(md.score) as avg_score, FORMAT(MAX(md.executed_at), 'dd-MM-yyyy') AS executed_at, COUNT(md.id) AS total_mission_details, COUNT(CASE WHEN md.score IS NOT NULL THEN md.id ELSE NULL END) AS scored_mission_details, (COUNT(CASE WHEN md.score IS NOT NULL THEN md.id ELSE NULL END) / COUNT(md.id)) * 100 AS progress_status");
            } else {
                $processes = $processes->selectRaw('p.id as process_id, p.name as process, d.name as domain, f.name as family, COUNT(cp.id) as control_points_count, AVG(md.score) as avg_score, DATE_FORMAT(MAX(md.executed_at), "%d-%m-%Y") AS executed_at, COUNT(md.id) AS total_mission_details, COUNT(IF(md.score IS NOT NULL, md.id, NULL)) AS scored_mission_details, (COUNT(IF(md.score IS NOT NULL, md.id, NULL)) / COUNT(md.id)) * 100 AS progress_status');
            }
            $processes = $processes->join('control_points as cp', 'p.id', '=', 'cp.process_id')
                ->join('domains as d', 'd.id', '=', 'p.domain_id')
                ->join('famillies as f', 'f.id', '=', 'd.familly_id')
                ->join('mission_details as md', 'cp.id', '=', 'md.control_point_id')
                ->join('missions as m', 'm.id', '=', 'md.mission_id')
                ->groupBy('p.id', 'p.name', 'd.name', 'f.name')
                ->where('m.id', $mission->id);
            $processes = !hasRole(['cdc', 'ci']) ? $processes->whereIn('md.score', [2, 3, 4]) : $processes;
            $processes = $processes->orderBy('p.id')->get();
            $search = request()->has('search') ? request()->search : false;
            if ($search) {
                $processes = $processes->filter(fn ($processe) => preg_match('/' . strtolower($search) . '/', strtolower($processe->name)));
            }
            $perPage = request()->has('perPage') && !empty(request()->perPage) && request()->perPage !== 'undefined' ? request()->perPage : 10;
            return MissionProcessesResource::collection(paginate($processes, '/api/missions/' . $mission->id, $perPage));
        }

        $mission = $mission->load(['agency', 'dre', 'agencyControllers', 'dcpControllers', 'cdcrValidator', 'dcpValidator', 'campaign' => fn ($campaign) => $campaign->without('processes')])->unsetRelation('details');

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
        $agencies = [];
        $controllers = [];

        abort_if(!ControlCampaign::count(), 423, 'Aucune campagne de contrôle n\'existe encore');
        $currentCampaign = ControlCampaign::current();
        abort_if(!$currentCampaign->validated_by_id, 403);
        $campaigns = formatForSelect(ControlCampaign::validated()->orderBy('reference', 'DESC')->get()->toArray(), 'reference');
        if (request()->has('campaign_id')) {
            $user = auth()->user();
            $currentCampaign = ControlCampaign::findOrFail(request()->campaign_id)->load(['missions']);
            $missions = $currentCampaign?->missions;
            $agencies = $user->agencies()->with('users')->get();

            $controllers = (clone $agencies)->pluck('users')->flatten()->filter(function ($user) use ($missions) {
                return $user->isAbleTo('control_agency') && $user->id !== auth()->user()->id;
            })->unique('id')->flatten()->toArray();
            $controllers = formatForSelect($controllers, 'full_name');

            $agencies = formatForSelect(($user->dres)->pluck('agencies')->flatten()->filter(function ($agency) use ($missions) {
                return !in_array($agency?->id, $missions->pluck('agency')->flatten()->pluck('id')->toArray());
            })->flatten()->toArray(), 'full_name');
        }
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
            $campaign->load('processes');
            $agency = $data['agency'];
            $agency = Agency::findOrFail($agency);
            DB::transaction(function () use ($data, $agency, $campaign) {
                $reference = 'RAP' . str_replace('-', '', str_replace('CDC-', '', $campaign->reference)) . '/' . $agency->code;
                $controlPoints = $this->loadControlPoints($campaign, $agency);
                $mission = Mission::create([
                    'reference' => $reference,
                    'control_campaign_id' => $campaign->id,
                    'agency_id' => $agency->id,
                    'created_by_id' => auth()->user()->id,
                    'start' => $data['start'],
                    'end' => $data['end'],
                    'note' => $data['note'],
                ]);
                $state = $mission->states()->create(['state' => 'À réaliser']);
                $mission->update(['state_id' => $state->id]);
                $mission->agencyControllers()->attach($data['controllers']);
                $mission->details()->createMany($controlPoints);
                foreach ($mission->agencyControllers as $controller) {
                    Notification::send($controller, new Assigned($mission));
                }
            });
            // foreach ($data['agencies'] as $agency) {
            // }

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
     * Validate mission
     *
     * @param Mission $mission
     * @param int $step
     *
     * @return Illuminate\Http\Response
     */
    public function validateMission(Mission $mission, int $step)
    {
        $isAbleOrAbort = $step == 1 ? 'make_first_validation' : 'make_second_validation';
        $cond = $step == 1 ? $mission->cdcr_validation_at : $mission->dcp_validation_at;
        isAbleOrAbort($isAbleOrAbort);
        abort_if($cond, 403);

        try {
            $res = DB::transaction(function () use ($mission, $step) {
                $validatedByIdColumn = 'dcp_validation_by_id';
                $validationAtColumn = 'dcp_validation_at';
                $users = User::whereRoles(['cdcr', 'dg', 'cdrcp']);
                $users = User::whereRoles(['da'])->whereRelation('agencies', 'agencies.id', $mission->agency_id)->get()->merge($users->get());
                if ($step == 1) {
                    $validatedByIdColumn = 'cdcr_validation_by_id';
                    $validationAtColumn = 'cdcr_validation_at';
                    $users = User::whereRoles(['dcp'])->get();
                    if (!$mission->has_dcp_controllers) {
                        $mission->dcpControllers()->syncWithPivotValues(auth()->user()->id, ['control_agency' => false]);
                    }
                }
                $res = $mission->update([
                    $validatedByIdColumn => auth()->user()->id,
                    $validationAtColumn => now()
                ]);
                if ($step == 1) {
                    $mission->states()->create(['state' => '1ère validation']);
                } else {
                    $mission->states()->create(['state' => '2ème validation']);
                }
                if ($res) {
                    foreach ($users as $user) {
                        Notification::send($user, new Validated($mission));
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
            return compact('message', 'status');
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
                $mission->update([
                    'start' => $data['start'],
                    'end' => $data['end'],
                    'note' => $data['note'],
                ]);
                $users = $mission->agencyControllers();
                if (auth()->user()->id) {
                }
                foreach ($users->get() as $user) {
                    Notification::send($user, new Updated($mission));
                }
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

    /**
     * Assign mission to CC
     *
     * @param AssignToCCRequest $request
     * @param Mission $mission
     *
     * @return Illuminate\Http\Response
     */
    public function assignToCC(AssignToCCRequest $request, Mission $mission)
    {
        try {
            DB::transaction(function () use ($request, $mission) {
                $mission->load('dcpControllers');
                $existingControllers = $mission->dcpControllers;
                $mission->dcpControllers()->syncWithPivotValues($request->controllers, ['control_agency' => false]);
                $updatedControllers = $mission->dcpControllers()->get();

                // Notify added controllers
                foreach ($updatedControllers as $controller) {
                    if (!in_array($controller->id, $existingControllers->pluck('id')->toArray())) {
                        Notification::send($controller, new Assigned($mission));
                    }
                }

                // Notify removed controllers
                $removedControllers = array_diff($existingControllers->pluck('id')->toArray(), $updatedControllers->pluck('id')->toArray());
                $removedControllers = User::whereIn('id', $removedControllers)->get();
                foreach ($removedControllers as $controller) {
                    Notification::send($controller, new AssignationRemoved($mission));
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

    private function loadAgencies(ControlCampaign $campaign)
    {
    }

    /**
     * Load all usable control points for specific agency
     *
     * @param ControlCampaign $campaign
     * @param Agency $agency
     *
     * @return array
     */
    private function loadControlPoints(ControlCampaign $campaign, Agency $agency): array
    {
        $agency->load(['unusableProcesses', 'usableProcesses']);

        $campaignProcesses = $campaign->processes;
        $categoryProcesses = [];
        if ($campaignProcesses->count()) {
            $categoryProcesses = $agency->category->processes;
            $exceptionalUsableAgencyProcesses = $agency->usableProcesses;
            $exceptionalUnusableAgencyProcesses = $agency->unusableProcesses->pluck('id')->toArray();

            $categoryProcesses = $categoryProcesses->merge($exceptionalUsableAgencyProcesses)->unique('id'); // Ajout des processus exceptionelles

            $categoryProcesses = $categoryProcesses->filter(function ($process) use ($exceptionalUnusableAgencyProcesses) {
                return !in_array($process->id, $exceptionalUnusableAgencyProcesses); // suppression des processus exceptionelles
            });

            $categoryProcesses = $categoryProcesses->pluck('id')->toArray();
        }
        return $campaignProcesses->filter(function ($process) use ($categoryProcesses) {
            return in_array($process->id, $categoryProcesses); // garder que les processus utilisés par la catégorie
        })->pluck('control_points')->flatten()->pluck('id')->map(fn ($controlPoint) => ['control_point_id' => $controlPoint])->toArray();
    }
}
