<?php

namespace App\Http\Controllers\Api;

use App\Enums\MissionState;
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
use App\Models\Process;
use App\Models\User;
use App\Notifications\Mission\AssignationRemoved;
use App\Notifications\Mission\Assigned;
use App\Notifications\Mission\Updated;
use App\Notifications\Mission\Validated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

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

            $missions = getMissions();
            // foreach ($missions->get() as $mission) {
            //     $mission = Mission::findOrFail($mission->id);
            //     $mission->update(['reel_start' => $mission->details()->orderBy('controlled_by_ci_at', 'ASC')->first()->controlled_by_ci_at]);
            // }
            $campaignId = request('campaign_id', null);
            $campaignId = request('campaignId', $campaignId);
            if ($campaignId) {
                $missions = $missions->where('control_campaign_id', $campaignId);
            }
            if ($fetchFilters) {
                return $this->filters($missions);
            }

            if ($sort) {
                $missions = $missions->sortByMultiple($sort);
            } else {
                $missions = $missions->orderBy('m.programmed_start', 'DESC')->orderBy('m.current_state', 'DESC');
            }

            if ($search) {
                $missions = $missions->search(['m.reference'], $search);
            }

            if ($filter) {
                $missions = $this->filter($missions, $filter);
            }

            if ($fetchAll) {
                $missions = formatForSelect($missions->get()->toArray(), 'reference');
            } else {
                $missions = MissionResource::collection($missions->paginate($perPage)->onEachSide(1));
            }

            return $missions;
        } catch (\Throwable $th) {
            return throwedError($th);
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

        $currentUser = auth()->user();
        $dreControllers = $mission->dreControllers->pluck('id')->toArray();
        $dcpControllers = $mission->dcpControllers->pluck('id')->toArray();
        $agencies = $currentUser->agencies->pluck('id')->toArray();

        $condition = (in_array($currentUser->id, $dreControllers)
            || in_array($currentUser->id, $dcpControllers)
            || $mission->created_by_id == $currentUser->id
            || (hasRole(['dcp']) && $mission->is_validated_by_cdcr)
            || (hasRole(['cdcr']) && $mission->is_validated_by_cdc)
            || (hasRole(['dg', 'cdrcp', 'ig', 'der', 'sg', 'deac', 'dga']) && $mission->is_validated_by_dcp)
            || (hasRole(['dre', 'da']) && in_array($mission->agency->id, $agencies) && $mission->is_validated_by_dcp)
            || hasRole('root')
        );
        abort_if(!$condition, 401, __('unauthorized'));
        if (!isAbleTo('view_opinion')) {
            $mission->makeHidden('opinion');
        }
        if (request()->has('edit')) {
            $condition = $mission->remaining_days_before_start > 5;
            abort_if(!$condition, 401, __('unauthorized'));
        }

        if (!hasRole(['cdc', 'ci'])) {
            $mission->makeHidden('ci_report');
        }
        $mission = $mission->load([
            'agency',
            'dre',
            'dreControllers',
            'dcpControllers',
            'ciValidator',
            'cdcValidator',
            'ccValidator',
            'cdcrValidator',
            'dcpValidator',
            'daRegularizator',
            'campaign' => fn ($campaign) => $campaign->select('reference', 'id')->without('processes'),
            'missionOrder',
            'closingReport'
        ])->unsetRelation('details');

        $mission->makeHidden(['dcp_validation_by_id', 'cdcr_validation_by_id', 'cdc_validation_by_id', 'ci_validation_by_id', 'cc_validation_by_id', 'agency_id', 'control_campaign_id', 'created_by_id']);

        return $mission;
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
        $data['creator_full_name'] = auth()->user()->full_name;
        try {
            $campaign = ControlCampaign::findOrFail($data['control_campaign_id']);
            $campaign->load('processes');
            $agency = $data['agency'];
            $agency = Agency::findOrFail($agency);
            $result = DB::transaction(function () use ($data, $agency, $campaign) {
                $reference = 'RAP' . str_replace('-', '', str_replace('CDC-', '', $campaign->reference)) . '/' . $agency->code;
                $controlPoints = $this->loadControlPoints($campaign, $agency);
                $mission = Mission::create([
                    'reference' => $reference,
                    'control_campaign_id' => $campaign->id,
                    'agency_id' => $agency->id,
                    'created_by_id' => $data['created_by_id'],
                    'creator_full_name' => $data['creator_full_name'],
                    'programmed_start' => $data['programmed_start'],
                    'programmed_end' => $data['programmed_end'],
                    'note' => $data['note'],
                ]);
                $mission->dreControllers()->attach($data['controllers']);
                $mission->details()->createMany($controlPoints);
                foreach ($mission->dreControllers as $controller) {
                    Notification::send($controller, new Assigned($mission));
                }
                return $mission;
            });
            return actionResponse($result->wasRecentlyCreated, 'Mission répartie avec succès');
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
                $mission->dreControllers()->sync($data['controllers']);
                $mission->update([
                    'programmed_start' => $data['programmed_start'],
                    'programmed_end' => $data['programmed_end'],
                    'note' => $data['note'],
                ]);
                $users = $mission->dreControllers();
                if (auth()->user()->id) {
                }
                foreach ($users->get() as $user) {
                    Notification::send($user, new Updated($mission));
                }
            });

            return response()->json([
                'message' => 'Informations de la mission mis à jour avec succès',
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
                    'message' => 'Mission supprimer avec succès',
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

    public function details(Mission $mission, Process $process)
    {
        isAbleOrAbort(['view_mission', 'control_agency']);
        $currentUser = auth()->user();
        $dreControllers = $mission->dreControllers->pluck('id')->toArray();
        $dcpControllers = $mission->dcpControllers->pluck('id')->toArray();
        $agencies = $currentUser->agencies->pluck('id')->toArray();

        $condition = (in_array($currentUser->id, $dreControllers)
            || in_array($currentUser->id, $dcpControllers)
            || $mission->created_by_id == $currentUser->id
            || (hasRole(['dcp']) && $mission->is_validated_by_cdcr)
            || (hasRole(['cdcr']) && $mission->is_validated_by_cdc)
            || (hasRole(['dg', 'cdrcp', 'ig', 'der', 'sg', 'deac', 'dga']) && $mission->is_validated_by_dcp)
            || (hasRole(['dre', 'da']) && in_array($mission->agency->id, $agencies) && $mission->is_validated_by_dcp)
            || hasRole('root')
        );
        abort_if(!$condition, 401, __('unauthorized'));
        $details = $mission->details()->with(['controlPoint' => fn ($query) => $query->with('fields')])->orderBy('control_point_id');
        $mission->unsetRelations();
        $process->load(['family', 'domain', 'media']);
        if (request()->has('onlyAnomaly')) {
            $details = $details->whereAnomaly();
        }
        $details = $details->whereRelation('process', 'processes.id', $process->id);

        $details = $details->get();
        $mode = false;
        if (hasRole(['ci'])) {
            $mode = 1; // Execution mode
        } elseif (hasRole('cdc')) {
            $mode = 2; // Revision mode
        } elseif (hasRole('cc')) {
            $mode = 3; // First processing mode
        } elseif (hasRole('cdcr')) {
            $mode = 4; // Second processing mode
        } elseif (hasRole('dcp')) {
            $mode = 5; // Third processing mode
        } else {
            $mode = 6; // Readonly mode
        }
        return compact('mission', 'details', 'process', 'mode');
    }

    /**
     * Validate mission
     *
     * @param Mission $mission
     * @param string $step
     *
     * @return Illuminate\Http\Response
     */
    public function validateMission(Mission $mission, string $type)
    {
        try {
            $attributes = $this->validationAttributes($mission, $type);
            abort_if(!$attributes['isAbleOrAbort'], FORBIDDEN);
            return DB::transaction(function () use ($mission, $attributes, $type) {
                $mission->update([
                    $attributes['validationAtColumn'] => now(),
                    $attributes['validationByColumn'] => auth()->user()->id,
                    $attributes['persistedValidationColumn'] => strlen($attributes['persistedValidationColumn']) ? auth()->user()->full_name : null,
                    'current_state' => $attributes['missionState']
                ]);
                if (!hasRole('dcp')) {
                    if ($attributes['notify'] instanceof Collection) {
                        foreach ($attributes['notify'] as $user) {
                            Notification::send($user, new Validated($mission, $type));
                        }
                    } else {
                        Notification::send($attributes['notify'], new Validated($mission, $type));
                    }
                }
                if (hasRole('dcp')) {
                    GenerateMissionReportPdf::dispatch($mission);
                }
                return response()->json([
                    'message' => MISSION_VALIDATION_SUCCESS,
                    'status' => true,
                ]);
            });
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            $status = false;
            return compact('message', 'status');
        }
    }
    /**
     * Prepare database attribute and ACLs for validation
     *
     * @param App\Models\Mission $mission
     * @param string $type
     * @return Collection
     **/
    public function validationAttributes(Mission $mission, string $type)
    {
        switch ($type) {
            case 'ci':
                $validationAtColumn = 'ci_validation_at';
                $validationByColumn = 'ci_validation_by_id';
                $persistedValidationColumn = '';
                $isAbleOrAbort = hasRole('ci') && $mission->dreControllers->contains('id', auth()->user()->id);
                $notify = $mission->creator;
                $missionState = MissionState::PENDING_CDC_VALIDATION;
                break;
            case 'cdc':
                $validationAtColumn = 'cdc_validation_at';
                $validationByColumn = 'cdc_validation_by_id';
                $persistedValidationColumn = 'cdc_validator_full_name';
                $isAbleOrAbort = hasRole('cdc') && $mission->created_by_id == auth()->user()->id;
                $notify = User::whereRoles(['cdcr'])->get();
                $missionState = MissionState::PENDING_CDCR_VALIDATION;
                break;
            case 'cdcr':
                $validationAtColumn = 'cdcr_validation_at';
                $validationByColumn = 'cdcr_validation_by_id';
                $persistedValidationColumn = 'cdcr_validator_full_name';
                $isAbleOrAbort = hasRole('cdcr');
                $notify = User::whereRoles(['dcp'])->get();
                $missionState = MissionState::PENDING_DCP_VALIDATION;
                break;
            case 'cc':
                $validationAtColumn = 'cc_validation_at';
                $validationByColumn = 'cc_validation_by_id';
                $persistedValidationColumn = '';
                $isAbleOrAbort = hasRole('cc') && $mission->dcpControllers->contains('id', auth()->user()->id);
                $notify = User::whereRoles(['cdcr'])->get();
                $missionState = MissionState::PENDING_CDCR_VALIDATION;
                break;
            case 'dcp':
                $validationAtColumn = 'dcp_validation_at';
                $validationByColumn = 'dcp_validation_by_id';
                $persistedValidationColumn = 'dcp_validator_full_name';
                $isAbleOrAbort = hasRole('dcp');
                $missionState = MissionState::PENDING_DA_VALIDATION;
                $notify = [];
                break;
            case 'da':
                $validationAtColumn = 'da_validation_at';
                $validationByColumn = 'da_validation_by_id';
                $persistedValidationColumn = 'da_validator_full_name';
                $isAbleOrAbort = hasRole('da') && auth()->user()->hasAgencies($mission->agency_id) && isAbleTo('regularize_mission_detail');
                $notify = User::whereRoles(['cdcr', 'cdrcp', 'dcp']);
                $notify = User::whereRoles(['dre'])->whereRelation('agencies', 'agencies.id', $mission->agency_id)->get()->merge($notify->get());
                $notify = $notify->merge($mission->dcpControllers)->merge($mission->dreControllers);
                $missionState = MissionState::DONE;
                break;
            default:
                $validationAtColumn = 'ci_validation_at';
                $validationByColumn = 'ci_validation_by_id';
                $persistedValidationColumn = '';
                $isAbleOrAbort = hasRole('ci') && $mission->dreControllers->contains('id', auth()->user()->id);
                $notify = $mission->creator;
                $missionState = MissionState::PENDING_CDC_VALIDATION;
                break;
        }

        return compact('validationAtColumn', 'validationByColumn', 'isAbleOrAbort', 'notify', 'missionState', 'persistedValidationColumn');
    }

    /**
     * Handle mission report action [Export, Generate]
     *
     * @param Mission $mission
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Illuminate\Foundation\Bus\PendingDispatch
     */
    public function handleReport(Mission $mission)
    {
        $fileExists = Storage::exists($mission->report_path);
        if (request()->action == 'generate' && !$fileExists) {
            if (!Cache::has('mission_report_generated_' . $mission->reference)) {
                Cache::rememberForever('mission_report_generated_' . $mission->reference, fn () => true);
                $this->generateReport($mission);
            } else {
                return $this->exportReport($mission);
            }
        } elseif (request()->action == 'export' && $fileExists) {
            return $this->exportReport($mission);
        } else {
            return response()->json(['error' => "L'action que vous avez choisit n'existe pas."], 404);
        }
    }

    public function missionReportIsGenerated(Mission $mission)
    {
        return response()->json((bool) Cache::has('mission_report_generated_' . $mission->reference) || $mission->pdf_report_exists);
    }

    /**
     * Export mission report
     *
     * @param Mission $mission
     *
     * @return \Illuminate\Http\Response
     */
    private function exportReport(Mission $mission)
    {
        $filename = $mission->report_path;
        $file = Storage::get($filename);
        // Determine the MIME type
        $mime = Storage::mimeType($filename);
        // Create a response with the file contents and appropriate headers
        $response = response($file, 200)->header('Content-Type', $mime);

        return $response;
    }

    /**
     * Generate mission report
     *
     * @param Mission $mission
     *
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     */
    private function generateReport(Mission $mission)
    {
        return GenerateMissionReportPdf::dispatch($mission);
    }

    /**
     * Fetch mission processes
     *
     * @param Mission $mission
     *
     * @return Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
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
        $campaigns = DB::table('control_campaigns as cc');
        abort_if(!$campaigns->count(), 423, 'Aucune campagne de contrôle n\'existe encore');
        $currentCampaign = (clone $campaigns)->select(
            'cc.reference',
            'cc.id',
            'cc.validated_by_id',
            'cc.description',
            DB::raw('CONVERT(NVARCHAR(10), start_date, 105) as start_date'),
            DB::raw('CONVERT(NVARCHAR(10), end_date, 105) as end_date'),
            DB::raw('DATEDIFF(day, CAST(GETDATE() AS DATE),start_date) as remaining_days_before_start'),
            DB::raw('DATEDIFF(day, end_date, CAST(GETDATE() AS DATE)) as remaining_days_before_end'),
            DB::raw('(CASE WHEN cc.validated_at IS NOT NULL THEN 1 ELSE 0 END) AS is_validated')
        )->orderBy('created_at', 'DESC');
        if (request('campaign_id')) {
            $currentCampaign = $currentCampaign->where('id', request('campaign_id'))->first();
        } else {
            $currentCampaign = $currentCampaign->first();
        }

        $currentCampaign->remaining_days_before_start_str = $this->remainingDaysBeforeStartStr($currentCampaign->remaining_days_before_start, $currentCampaign->remaining_days_before_end);
        $currentCampaign->remaining_days_before_end_str = $this->remainingDaysBeforeEndStr($currentCampaign->remaining_days_before_end);

        abort_if(!$currentCampaign->validated_by_id, 403);
        $campaigns = (clone $campaigns)->select('cc.reference', 'cc.id')->whereNotNull('validated_by_id')->orderBy('reference', 'DESC')->get()->map(fn ($item) => ['reference' => $item->reference, 'id' => $item->id])->toArray();
        $campaigns = formatForSelect($campaigns, 'reference');

        if (request()->has('campaign_id')) {
            $user = auth()->user();

            $missions = DB::table('missions as m')->where('control_campaign_id', $currentCampaign->id)->get();
            $missionsAgency = (clone $missions)->pluck('agency_id')->toArray();

            $agencies = DB::table('agencies as a')->select(
                'a.id',
                DB::raw("CONCAT(a.code, ' - ', a.name) as full_name")
            )
                ->leftJoin('user_has_agencies as uha', 'a.id', 'uha.agency_id')
                ->where('uha.user_id', $user->id)->get();

            $controllers = DB::table('users as u')->select('u.id', 'u.username')
                ->leftJoin('user_has_agencies as uha', 'u.id', 'uha.user_id')
                ->leftJoin('roles as r', 'u.active_role_id', 'r.id')
                ->whereIn('uha.agency_id', (clone $agencies)->pluck('id')->toArray())
                ->where('r.code', 'ci')
                ->groupBy('u.id', 'u.username')
                ->where('u.is_active', true)
                ->get();

            // Format controllers array before serve
            $controllers = $controllers->filter(function ($user) {
                return $user->id !== auth()->user()->id;
            })->flatten()->map(fn ($item) => ['id' => $item->id, 'username' => $item->username])->unique('id')->toArray();
            $controllers = formatForSelect($controllers, 'username');

            // Format agencies array before serve
            $agencies = $agencies->filter(function ($agency) use ($missionsAgency) {
                return !in_array($agency?->id, $missionsAgency);
            })->flatten()->map(fn ($item) => ['id' => $item->id, 'full_name' => $item->full_name])->toArray();

            $agencies = formatForSelect($agencies, 'full_name');
        }
        return compact('agencies', 'campaigns', 'controllers', 'currentCampaign');
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

                if ($mission->dcpControllers->count()) {
                    $mission->update(['current_state' => MissionState::PENDING_CC_VALIDATION]);
                } else {
                    $mission->update(['current_state' => MissionState::PENDING_CDCR_VALIDATION]);
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
        // TODO
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

    /**
     * Load processes
     *
     * @param Mission $mission
     * @param bool $paginated
     * @param bool $formated
     * @param bool $onlyWhereAnomaly
     *
     * @return Illuminate\Support\Collection
     */
    private function loadProcesses(Mission $mission, bool $paginated = false, bool $formated = false, bool $onlyWhereAnomaly = false)
    {
        $mission->unsetRelations();
        $processes = getMissionProcesses($mission);
        $processes = !hasRole(['cdc', 'ci']) && $onlyWhereAnomaly ? $processes->whereIn('md.score', [2, 3, 4]) : $processes;
        $search = request('search', false);
        $sort = request('sort', false);

        if ($sort) {
            foreach ($sort as $key => $value) {
                $processes = $processes->orderBy($key, $value);
            }
        } else {
            $processes = $processes->orderBy('f.id')->orderBy('p.id');
        }
        $processes = $processes->get();
        if ($search) {
            $processes = $processes->filter(fn ($processe) => preg_match('/' . strtolower($search) . '/', strtolower($processe->process)));
        }
        if ($formated) {
            $processes = formatForSelect($processes->toArray());
        }
        return $processes;
    }

    /**
     * Load filters data
     *
     * @param mixed $data
     *
     * @return Array
     */
    private function loadFilters($data)
    {
        $family = formatForSelect((clone $data)->uniqueStrict('family')->map(fn ($item) => (array) $item)->toArray(), 'family', 'family');
        $domain = formatForSelect((clone $data)->uniqueStrict('domain')->map(fn ($item) => (array) $item)->toArray(), 'domain', 'domain');

        return  compact('family', 'domain');
    }

    /**
     * Filter data
     *
     * @param mixed $data
     *
     * @return Illuminate\Support\Collection
     */
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
     * @return string
     */
    private function remainingDaysBeforeStartStr($remaining_days_before_start, $remaining_days_before_end): string
    {
        $remainingDays = $remaining_days_before_start > 1 ? $remaining_days_before_start . ' jours' : $remaining_days_before_start . ' jour';

        if ($remaining_days_before_start < 0 && $remaining_days_before_end) {
            return 'En cours';
        }
        return $remaining_days_before_end ? $remainingDays : '-';
    }

    /**
     * @return string
     */
    private function remainingDaysBeforeEndStr($remaining_days_before_end): string
    {
        $remainingDays = $remaining_days_before_end < 1 ? abs($remaining_days_before_end) . ' jours' : abs($remaining_days_before_end) . ' jour';
        return $remaining_days_before_end ? $remainingDays : '-';
    }

    /**
     * Get details filters data
     *
     * @param Builder $missions
     *
     * @return array
     */
    public function filters(Builder $missions): array
    {
        $missions = $missions->get();

        $dre = [];
        $agency = [];
        $campaign = formatForSelect(getControlCampaigns()->get()->map(fn ($item) => ['id' => $item->id, 'reference' => $item->reference])->toArray(), 'reference');
        $mission = [];
        if (isset(request()->filter['campaign'])) {

            $campaigns = explode(',', request()->filter['campaign']);

            $dre = getDre()
                ->join('agencies as a', 'd.id', 'a.dre_id')
                ->join('missions as m', 'm.agency_id', 'a.id')
                ->whereIn('m.control_campaign_id', $campaigns)
                ->having(DB::raw('COUNT(m.id)'), '>', 0)
                ->get()
                ->map(fn ($item) => ['id' => $item->id, 'full_name' => $item->full_name])->toArray();
            $dre = formatForSelect($dre, 'full_name');

            if (isset(request()->filter['dre'])) {
                $dres = explode(',', request()->filter['dre']);
                $agency = getAgencies()
                    ->join('missions as m', 'm.agency_id', 'a.id')
                    ->whereIn('dre_id', $dres)
                    ->having(DB::raw('COUNT(m.id)'), '>', 0)
                    ->get()
                    ->map(fn ($item) => ['id' => $item->id, 'full_name' => $item->full_name])->toArray();
                $agency = formatForSelect($agency, 'full_name');
            }
        }

        return compact('campaign', 'dre', 'agency');
    }

    /**
     * Filter data
     *
     * @param Builder $missions
     * @param array $filter
     *
     * @return Builder
     */
    public function filter(Builder $missions, array $filter): Builder
    {
        if (isset($filter['campaign'])) {
            $values = explode(',', $filter['campaign']);
            $missions = $missions->whereIn('control_campaign_id', $values);
        }

        if (isset($filter['dre'])) {
            $values = explode(',', $filter['dre']);
            $missions = $missions->whereIn('dre_id', $values);
        }

        if (isset($filter['agency'])) {
            $values = explode(',', $filter['agency']);
            $missions = $missions->whereIn('agency_id', $values);
        }

        if (isset($filter['current_state'])) {
            $values = explode(',', $filter['current_state']);
            $missions = $missions->whereIn('current_state', $values);
        }

        if (isset($filter['progress_status'])) {
            $filterValue = $filter['progress_status'];
            $column = DB::raw('SUM(CASE WHEN md.score IS NOT NULL THEN 1 ELSE 0 END) * 100 / COUNT(md.id)');
            if ($filterValue == '-20') {
                $missions = $missions->havingRaw("$column <= 20");
            } elseif ($filterValue == '-40') {
                $missions = $missions->havingRaw("$column >= 20 AND $column < 40");
            } elseif ($filterValue == '-60') {
                $missions = $missions->havingRaw("$column >= 40 AND $column < 60");
            } elseif ($filterValue == '-80') {
                $missions = $missions->havingRaw("$column >= 60 AND $column < 80");
            } elseif ($filterValue == '-100') {
                $missions = $missions->havingRaw("$column >= 80 AND $column < 100");
            } elseif ($filterValue == '100') {
                $missions = $missions->havingRaw("$column = 100");
            }
        }

        if (isset($filter['avg_score'])) {
            $filterValue = $filter['avg_score'];
            $column = DB::raw('CAST(ROUND(AVG(CAST(md.score AS DECIMAL(10, 2))), 2) AS DECIMAL(10, 2))');
            if ($filterValue == 'score >= 1 AND score < 2') {
                $missions = $missions->havingRaw("$column >= 1 AND $column < 2");
            } elseif ($filterValue == 'score >= 2 AND score < 3') {
                $missions = $missions->havingRaw("$column >= 2 AND $column < 3");
            } elseif ($filterValue == 'score >= 3 AND score < 4') {
                $missions = $missions->havingRaw("$column >= 3 AND $column < 4");
            } elseif ($filterValue == 'score >= 4') {
                $missions = $missions->havingRaw("$column >= 4");
            }
        }
        return $missions;
    }
}
