<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\AssignToCCRequest;
use App\Http\Requests\Mission\StoreRequest;
use App\Http\Requests\Mission\UpdateRequest;
use App\Http\Resources\MissionProcessesResource;
use App\Http\Resources\MissionResource;
use App\Jobs\GenerateMissionReportPdf;
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
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;

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
        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request('fetchAll', false);

        try {
            $missions = $this->getMissions();

            $campaignId = request('campaign_id', null);
            $campaignId = request('campaignId', $campaignId);
            if ($campaignId) {
                $missions = $missions->where('control_campaign_id', $campaignId);
            }
            if ($fetchFilters) {
                return $this->getFilters($missions);
            }

            if ($sort) {
                $missions = $missions->sortByMultiple($sort);
            } else {
                $missions = $missions->orderBy('created_at', 'DESC');
            }

            if ($search) {
                $missions = $missions->search($search);
            }

            if ($filter) {
                $missions = $missions->filter($filter);
            }

            if ($fetchAll) {
                $missions = formatForSelect($missions->get()->toArray(), 'reference');
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
     * Generate mission report in PDF format
     *
     * @param \App\Models\Mission $mission
     *
     * @return \Illuminate\Http\Response
     */
    public function export(Mission $mission)
    {
        // Dispatch the job and retrieve the returned filepath
        $job = new GenerateMissionReportPdf($mission);
        $filepath = Bus::dispatchNow($job);

        // Access the filepath and perform further actions
        if ($filepath) {
            // Process the filepath, such as downloading the file or displaying a success message
            return redirect($filepath);
        } else {
            // Handle the case where the filepath is empty or not available
            return back()->with('error', 'Failed to generate the mission report.');
        }
    }

    public function exportSnappy(Mission $mission)
    {
        try {
            $start = now();
            $mission->unsetRelations();
            $mission->load(['details', 'campaign']);
            $details = $mission->details()->whereIn('score', [1, 2, 3, 4])->get()->groupBy('familly.name');
            $end = now();
            $difference = $end->diffInRealMilliseconds($start);
            $campaign = $mission->campaign;
            $stats = [
                'avg_score' => $mission->avg_score,
                'total_processes' => $this->loadProcesses($mission)->count(),
                'total_anomalies' => $mission->details()->whereAnomaly()->count(),
                'total_major_facts' => $mission->details()->onlyMajorFacts()->count(),
            ];

            // $snappy = App::make('snappy.pdf');
            // $html = '<h1>Bill</h1><p>You owe me money, dude.</p>';
            // return $snappy->generateFromHtml($html, 'bill-123.pdf');
            $title = 'mission';
            $pdf = \SnappyPDF::loadView('export.mission', compact('mission', 'campaign', 'details', 'stats', 'title'));
            // $pdf->setOption('header-html', view('export.mission.header'));
            // $pdf->setOption('footer-html', view('export.mission.footer'));
            $filename = strtolower('rapport_mission-' . $mission->reference . '-' . str_replace(' ', '', $mission->agency->name) . '.pdf');
            return $pdf->stream($filename);
            $filename = strtolower('rapport_mission-' . $mission->reference . '-' . str_replace(' ', '', $mission->agency->name) . '.pdf');
            if (request()->has('mode') && request()->mode == "preview") {
                return $pdf->stream($filename);
            } else {
                return $pdf->download($filename);
            }
        } catch (\Throwable $th) {
            echo "<pre>";
            echo $th->getMessage();
            echo "</pre>";
        }
    }

    /**
     * Fetch user mission
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
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

    /**
     * Fetch missions filters
     *
     * @param Illuminate\Database\Eloquent\Builder|null $missions
     *
     * @return array
     */
    public function getFilters(Builder $missions = null)
    {
        $missions = $missions ?? $this->getMissions();
        $dre_controllers = $missions->relationUniqueData('agencyControllers', 'full_name', 'id');
        $dre = $missions->relationUniqueData('dre', 'name', 'id', 'full_name');
        $agency = $missions->relationUniqueData('agency', 'name', 'id', 'full_name');
        $campaign = $missions->relationUniqueData('campaign', 'reference');
        return compact('dre', 'agency', 'campaign', 'dre_controllers');
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

        // if (request()->has('onlyFilters')) {
        //     $processes = $this->loadProcesses($mission);
        //     return $this->loadFilters($processes);
        // }


        $mission = $mission->load(['agency', 'dre', 'agencyControllers', 'dcpControllers', 'cdcrValidator', 'dcpValidator', 'campaign' => fn ($campaign) => $campaign->without('processes')])->unsetRelation('details');

        return $mission;
    }

    public function processes(Mission $mission)
    {
        $processes = $this->loadProcesses($mission);
        $fetchFilters = request()->has('fetchFilters');
        if ($fetchFilters) {
            return $this->loadFilters($processes);
        }
        $processes = $this->filterData($processes);
        $perPage = request('perPage', 10);
        return MissionProcessesResource::collection(paginate($processes, '/api/missions/' . $mission->id, $perPage));
    }

    private function loadFilters($data)
    {
        $family = formatForSelect((clone $data)->uniqueStrict('family')->map(fn ($item) => (array) $item)->toArray(), 'family', 'family');
        $domain = formatForSelect((clone $data)->uniqueStrict('domain')->map(fn ($item) => (array) $item)->toArray(), 'domain', 'domain');

        return  compact('family', 'domain');
    }

    private function filterData($data)
    {
        if (request()->has('filter') && !empty(request()->filter)) {
            foreach (request()->filter as $key => $value) {
                if (!empty($value)) {
                    $values = explode(',', $value);
                    if (!empty($values)) {
                        $data = $data->whereIn($key, $values);
                    }
                }
            }
        }

        if (request()->has('search') && !empty(request()->search)) {
            $data = $data->filter(fn ($process) => preg_match('/' . strtolower(request()->search) . '/', strtolower($process->process)));
        }
        return $data;
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
                $users = User::whereRoles(['cdcr', 'dg', 'cdrcp', 'ig', 'sg', 'der']);
                $users = User::whereRoles(['da', 'dre'])->whereRelation('agencies', 'agencies.id', $mission->agency_id)->get()->merge($users->get());
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

    private function loadProcesses(Mission $mission, bool $paginated = false, bool $formated = false, bool $onlyWhereAnomaly = false)
    {
        $mission->unsetRelations();
        $processes = DB::table('processes as p');
        $processes = $processes->selectRaw("p.id as process_id, p.name as process, d.name as domain, f.name as family, f.id as family_id, d.id as domain_id,COUNT(cp.id) as control_points_count, AVG(md.score) as avg_score, FORMAT(MAX(md.executed_at), 'dd-MM-yyyy') AS executed_at, COUNT(md.id) AS total_mission_details, COUNT(CASE WHEN md.score IS NOT NULL THEN md.id ELSE NULL END) AS scored_mission_details, (COUNT(CASE WHEN md.score IS NOT NULL THEN md.id ELSE NULL END) / COUNT(md.id)) * 100 AS progress_status");
        $processes = $processes->join('control_points as cp', 'p.id', '=', 'cp.process_id')
            ->join('domains as d', 'd.id', '=', 'p.domain_id')
            ->join('famillies as f', 'f.id', '=', 'd.familly_id')
            ->join('mission_details as md', 'cp.id', '=', 'md.control_point_id')
            ->join('missions as m', 'm.id', '=', 'md.mission_id')
            ->groupBy('f.id', 'd.id', 'p.id', 'p.name', 'd.name', 'f.name')
            ->where('m.id', $mission->id);
        $processes = !hasRole(['cdc', 'ci']) && $onlyWhereAnomaly ? $processes->whereIn('md.score', [2, 3, 4]) : $processes;
        $processes = $processes->orderBy('f.id')->orderBy('p.id')->get();
        $search = request()->has('search') ? request()->search : false;
        if ($search) {
            $processes = $processes->filter(fn ($processe) => preg_match('/' . strtolower($search) . '/', strtolower($processe->process)));
        }
        if ($formated) {
            $processes = formatForSelect($processes->toArray());
        }
        return $processes;
    }
}
