<?php

namespace App\Http\Controllers\Api\AgencyLevel\Mission;

use App\DB\Queries\ControlCampaignQuery;
use App\DB\Queries\MissionQuery;
use App\Enums\EventLogTypes;
use App\Enums\MissionState;
use App\Exports\MissionsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\StoreRequest;
use App\Http\Requests\Mission\UpdateRequest;
use App\Http\Resources\MissionResource;
use App\Jobs\GenerateMissionReportPdf;
use App\Models\Structures\Agency;
use App\Models\ControlCampaign;
use App\Models\EventLog;
use App\Models\Mission;
use App\Models\User;
use App\Notifications\Mission\Assigned;
use App\Notifications\Mission\Updated;
use App\Notifications\Mission\Validated;
use App\Services\ExcelExportService;
use App\Traits\MissionConfig;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use App\Notifications\Mission\Deleted;

class MissionController extends Controller
{
    use MissionConfig;
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
        $page = request('page', 1);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request('fetchAll', false);


        $searchColumns  = ['m.reference', 'dci.first_name', 'dci.last_name', 'a.code', 'a.name'];
        if (hasRole(['dcp', 'cdcr', 'root', 'admin'])) {
            $searchColumns  = ['m.reference', 'dci.first_name', 'dci.last_name', 'dcc.first_name', 'dcc.last_name', 'a.code', 'a.name'];
        } elseif (hasRole('der')) {
            $searchColumns  = ['m.reference', 'dci.first_name', 'dci.last_name', 'cder.first_name', 'cder.last_name', 'a.code', 'a.name'];
        }

        try {
            $missions = (new MissionQuery)->prepare([
                'sort' => ['sort' => $sort, 'default' => ['m.current_state' => 'ASC', 'm.programmed_start' => 'DESC']],
                'search' => ['columns' => $searchColumns, 'value' => $search],
            ])->multiple();

            $export = request('export', []);
            $shouldExport = count($export) || request()->has('export');

            $campaignId = isset(request('filter')['campaign']) && !empty(request('filter')['campaign']) ? request('filter')['campaign'] : null;

            if ($campaignId) {
                $values = explode(',', $filter['campaign']);
                $missions = $missions->whereIn('control_campaign_id', $values);
            }

            if ($fetchFilters) {
                return $this->filters($missions);
            }

            if ($filter) {
                $missions = $this->filter($missions, $filter);
            }

            if ($shouldExport) {
                return (new ExcelExportService($missions, MissionsExport::class, 'liste_des_missions.xlsx', $export))->download();
            }

            if ($fetchAll) {
                $missions = formatForSelect($missions->get()->toArray(), 'reference');
            } else {
                $missions = MissionResource::collection($missions->paginate($perPage, ['*'], 'page', $page)->onEachSide(1));
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
        $dreController = $mission->dreController->id;
        $dreAssistants = $mission->assistants->pluck('id')->toArray();
        $dcpController = $mission->assigned_to_cc_id;
        $agencies = $currentUser->agencies->pluck('id')->toArray();

        $condition = $currentUser->id == $dreController
            || $currentUser->id == $dcpController
            || $mission->created_by_id == $currentUser->id
            || ($mission->assigned_to_cder_id == $currentUser->id && hasRole('cder'))
            || in_array(auth()->user()->id, $dreAssistants)
            || (hasRole(['cdcr', 'dcp']) && $mission->is_validated_by_cdc)
            || (hasRole(['dg', 'cdrcp', 'ig', 'iga', 'der', 'sg', 'deac', 'dga']) && $mission->is_validated_by_dcp)
            || (hasRole(['dre', 'da']) && in_array($mission->agency->id, $agencies) && $mission->is_validated_by_dcp)
            || hasRole(['root', 'admin']);

        abort_if(!$condition, FORBIDDEN, __('unauthorized'));
        if (!isAbleTo('view_opinion')) {
            $mission->makeHidden('opinion');
        }
        if (request()->has('edit')) {
            $condition = $mission->remaining_days_before_start > 5;
            abort_if(!$condition, FORBIDDEN, __('unauthorized'));
        }

        if (!hasRole(['cdc', 'ci'])) {
            $mission->makeHidden('ci_report');
        }

        if (hasRole('da')) {
            $mission->makeHidden('has_major_facts');
            $mission->makeHidden('total_major_facts');
        }
        $mission = $mission->load([
            'agency',
            'dre',
            'dreController',
            'assistants',
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
        $data['creator_full_name'] = getUserFullNameWithRole();
        try {
            $campaign = ControlCampaign::findOrFail($data['control_campaign_id']);
            $campaign->load('processes');
            $agency = $data['agency_id'];
            $agency = Agency::findOrFail($agency);
            $mission = DB::transaction(function () use ($data, $agency, $campaign) {
                $isForTesting = $campaign->is_for_testing ?: $data['is_for_testing'];
                $reference = 'RAP' . str_replace('-', '', str_replace('CDC-', '', $campaign->reference)) . '/' . $agency->code;
                $mission = Mission::create([
                    'reference' => $reference,
                    'control_campaign_id' => $campaign->id,
                    'agency_id' => $data['agency_id'],
                    'created_by_id' => $data['created_by_id'],
                    'creator_full_name' => $data['creator_full_name'],
                    'programmed_start' => $data['programmed_start'],
                    'programmed_end' => $data['programmed_end'],
                    'note' => $data['note'],
                    'is_for_testing' => $isForTesting,
                    'assigned_to_ci_id' => $data['head_of_mission_id'],
                ]);
                EventLog::store(['type' => EventLogTypes::CREATE, 'attachable_type' => Mission::class, 'attachable_id' => $mission->id]);

                $controlPoints = $this->loadControlPoints($campaign, $agency, $data['head_of_mission_id'], $mission);
                $details = $mission->details()->createMany($controlPoints);
                $assistants = $mission->assistants()->attach($data['assistants']);
                return $mission;
            });
            if (!$mission->is_for_testing && $mission->wasRecentlyCreated) {
                $users = $mission->assistants->merge([$mission->dreController]);
                foreach ($users as $user) {
                    Notification::send($user, new Assigned($mission));
                }
            }
            return actionResponse($mission->wasRecentlyCreated, 'La mission <b>' . $mission->reference . '</b> a été répartie avec succès');
        } catch (\Throwable $th) {
            EventLog::store(['type' => EventLogTypes::CREATE, 'attachable_type' => Mission::class, 'payload' => ['success' => false, 'content' => $th->getMessage()]]);
            return throwedError($th);
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
            $oldMission = clone $mission;
            $result = DB::transaction(function () use ($mission, $data) {
                $missionUpdatedResult = $mission->update([
                    'programmed_start' => $data['programmed_start'],
                    'programmed_end' => $data['programmed_end'],
                    'note' => $data['note'],
                    'agency_id' => $data['agency_id'],
                    'assigned_to_ci_id' => $data['head_of_mission_id']
                ]);
                $assistants = $mission->assistants()->sync($data['assistants']);
                return $missionUpdatedResult;
            });

            if ($result) {
                EventLog::store(['type' => EventLogTypes::UPDATE, 'attachable_type' => Mission::class, 'attachable_id' => $mission->id, 'payload' => ['success' => $result, 'old' => $oldMission, 'new' => $mission]]);
            } else {
                EventLog::store(['type' => EventLogTypes::UPDATE, 'attachable_type' => Mission::class, 'attachable_id' => $mission->id, 'payload' => ['success' => $result]]);
            }

            if (!$mission->is_for_testing && $result) {
                $users = $mission->assistants->merge([$mission->dreController]);
                foreach ($users as $user) {
                    Notification::send($user, new Updated($mission));
                }
            }

            return actionResponse($result, 'La mission <b>' . $mission->reference . '</b> est actualisée avec succès', UPDATE_ERROR);
        } catch (\Throwable $th) {
            EventLog::store(['type' => EventLogTypes::UPDATE, 'attachable_type' => Mission::class, 'attachable_id' => $mission->id, 'payload' => ['success' => false, 'content' => $th->getMessage()]]);
            return throwedError($th);
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
        abort_if($mission->remaining_days_before_start < 0, FORBIDDEN, "Vous n'êtes pas autoriser à supprimer la mission " . $mission->reference);

        try {
            $deletedMission = clone $mission;
            $succesMessage = "La mission <b>$deletedMission->reference</b> a bien été supprimer.";
            $action = DB::transaction(function () use ($mission) {
                $totalDeletedMissionsWithSameReference = DB::table('missions as m')->whereLike('reference', "%$mission->reference%")->whereNotNull('deleted_at')->get()->count();
                $mission->update([
                    'reference' => $mission->reference . '-' . ($totalDeletedMissionsWithSameReference + 1)
                ]);
                $errorMessage = DELETE_SUCCESS;
                if ($mission->remaining_days_before_start > 0) {
                    $result = $mission->delete();
                    $code = 200;
                } else {
                    $errorMessage = "Vous n'êtes pas autoriser à supprimer la mission " . $mission->reference;
                    $code = FORBIDDEN;
                    $result = false;
                }
                return compact('result', 'errorMessage', 'code');
            });
            EventLog::store(['type' => EventLogTypes::DELETE, 'attachable_type' => Mission::class, 'attachable_id' => $mission->id, 'payload' => ['success' => $action['result'], 'content' => $action['errorMessage']]]);
            if ($action['result']) {
                $users = $deletedMission->assistants->merge([$deletedMission->dreController]);
                foreach ($users as $user) {
                    Notification::send($user, new Deleted($deletedMission));
                }
            }
            return actionResponse($action['result'], $succesMessage, $action['errorMessage'], $action['code']);
        } catch (\Throwable $th) {
            EventLog::store(['type' => EventLogTypes::DELETE, 'attachable_type' => Mission::class, 'attachable_id' => $mission->id, 'payload' => ['success' => false, 'content' => $th->getMessage()]]);
            return throwedError($th);
        }
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
        if (hasRole('cdc')) {
            $totalUntreatedMajorFacts = $mission->details()->where('major_fact', true)->where('major_fact_is_rejected_at_dre', false)->whereNull('major_fact_is_dispatched_to_dcp_at')->count();
            if ($totalUntreatedMajorFacts) {
                $sentence = $totalUntreatedMajorFacts > 1 ? ' faits majeurs non traités' : ' fait majeur non traité';
                return actionResponse(false, '', "La mission <b>$mission->reference</b> ne peut pas être validée car elle contient <b>$totalUntreatedMajorFacts $sentence</b> !", 200);
            }
        } elseif (hasRole('dcp')) {
            $totalUntreatedMajorFacts = $mission->details()->where('major_fact', true)->where('major_fact_is_rejected_at_dcp', false)->whereNull('major_fact_is_dispatched_at')->count();
            if ($totalUntreatedMajorFacts) {
                $sentence = $totalUntreatedMajorFacts > 1 ? ' faits majeurs non traités' : ' fait majeur non traité';
                return actionResponse(false, '', "La mission <b>$mission->reference</b> ne peut pas être validée car elle contient <b>$totalUntreatedMajorFacts $sentence</b> !", 200);
            }
        }
        try {
            $attributes = $this->validationAttributes($mission, $type);
            abort_if(!$attributes['isAbleOrAbort'], FORBIDDEN);
            $result = DB::transaction(function () use ($mission, $attributes, $type) {
                $result = $mission->update([
                    $attributes['validationAtColumn'] => now(),
                    $attributes['validationByColumn'] => auth()->user()->id,
                    $attributes['persistedValidationColumn'] => strlen($attributes['persistedValidationColumn']) ? getUserFullNameWithRole() : null,
                    'current_state' => $attributes['missionState'],
                    'real_end' => hasRole('cdc') ? now() : $mission->real_end,
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
                    $this->generateReport($mission);
                }
                return $result;
            });
            EventLog::store(['type' => EventLogTypes::VALIDATE, 'attachable_type' => Mission::class, 'attachable_id' => $mission->id, 'payload' => ['success' => $result, 'content' => $result ? MISSION_VALIDATION_SUCCESS : MISSION_VALIDATION_ERROR]]);
            return actionResponse($result, MISSION_VALIDATION_SUCCESS, MISSION_VALIDATION_ERROR);
        } catch (\Throwable $th) {
            EventLog::store(['type' => EventLogTypes::VALIDATE, 'attachable_type' => Mission::class, 'attachable_id' => $mission->id, 'payload' => ['success' => false, 'content' => $th->getMessage()]]);
            return throwedError($th);
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
                $isAbleOrAbort = hasRole('ci') && $mission->dreController->id == auth()->user()->id;
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
                $isAbleOrAbort = hasRole('cc') && $mission->assigned_to_cc_id == auth()->user()->id;
                $notify = User::whereRoles(['cdcr'])->get();
                $missionState = MissionState::PENDING_CDCR_VALIDATION;
                break;
            case 'dcp':
                $validationAtColumn = 'dcp_validation_at';
                $validationByColumn = 'dcp_validation_by_id';
                $persistedValidationColumn = 'dcp_validator_full_name';
                $isAbleOrAbort = hasRole('dcp');
                $missionState = MissionState::DONE;
                $notify = User::whereRoles(['cdc', 'dre', 'da', 'ir'])->isActive()->whereRelation('agencies', 'agencies.id', $mission->agency_id)->get()->merge(User::whereRoles(['cdrcp', 'dg', 'dga', 'sg', 'ig', 'iga', 'deac', 'der'])->isActive()->get());
                $notify = $notify->merge([$mission->dreController]);
                break;
                // case 'da':
                //     $validationAtColumn = 'da_validation_at';
                //     $validationByColumn = 'da_validation_by_id';
                //     $persistedValidationColumn = 'da_validator_full_name';
                //     $isAbleOrAbort = hasRole('da') && auth()->user()->hasAgencies($mission->agency_id) && isAbleTo('regularize_mission_detail');
                //     $notify = User::whereRoles(['cdcr', 'cdrcp', 'dcp'])->isActive();
                //     $notify = User::whereRoles(['dre', 'cdc', 'ci'])->isActive()->whereRelation('agencies', 'agencies.id', $mission->agency_id)->get()->merge($notify->get());
                //     $notify = $notify->merge([$mission->dreController]);
                //     if ($mission->dcp_controller) {
                //         $notify = $notify->merge([$mission->dcp_controller]);
                //     }
                //     $missionState = MissionState::DONE;
                //     break;
            default:
                $validationAtColumn = 'ci_validation_at';
                $validationByColumn = 'ci_validation_by_id';
                $persistedValidationColumn = '';
                $isAbleOrAbort = hasRole('ci') && $mission->dreController->id == auth()->user()->id;
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
        if (request()->action == 'regenerate') {
            $this->generateReport($mission, false);
            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json(['error' => "L'action que vous avez choisit n'existe pas."], 404);
        }
    }

    /**
     * Generate mission report
     *
     * @param Mission $mission
     *
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     */
    private function generateReport(Mission $mission, $notify = true)
    {
        return GenerateMissionReportPdf::dispatch($mission, $notify);
    }

    /**
     * Load all usable control points for specific agency
     *
     * @param ControlCampaign $campaign
     * @param Agency $agency
     *
     * @return array
     */
    private function loadControlPoints(ControlCampaign $campaign, Agency $agency, int|string $assigned_to, Mission $mission): array
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
        $missionReference = str_replace('RAP', '', str_replace('/', '-', $mission->reference));
        return $campaignProcesses->filter(function ($process) use ($categoryProcesses) {
            return in_array($process->id, $categoryProcesses); // garder que les processus utilisés par la catégorie
        })->pluck('control_points')->flatten()->pluck('id')->map(function ($controlPoint) use ($assigned_to, $missionReference) {
            $controlPoint = DB::table('control_points as cp')->select(['cp.id as cp_id', 'p.id as p_id', 'd.id as d_id', 'f.id as f_id'])
                ->leftJoin('processes as p', 'p.id', 'cp.process_id')
                ->leftJoin('domains as d', 'd.id', 'p.domain_id')
                ->leftJoin('families as f', 'f.id', 'd.family_id')->where('cp.id', $controlPoint)->first();
            $reference = $missionReference . '-' . $controlPoint->f_id . '-' . $controlPoint->d_id . '-' . $controlPoint->p_id . '-' . $controlPoint->cp_id;
            return ['control_point_id' => $controlPoint->cp_id, 'assigned_to_ci_id' => $assigned_to, 'reference' => $reference];
        })->toArray();
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
        $dre = [];
        $agency = [];
        // $controllers = [];
        $campaign = (new ControlCampaignQuery())->prepare()->multiple()
            ->whereNotNull('m.reference')
            ->get()
            ->unique()
            ->map(fn ($item) => ['id' => $item->id, 'reference' => $item->reference])
            ->toArray();
        $campaign = formatForSelect($campaign, 'reference');
        $mission = [];
        if (isset(request()->filter['campaign'])) {
            $filterDre = isset(request()->filter['dre']) ? request()->filter['dre'] : '';
            if (hasRole(['cdc', 'ci', 'da', 'dre'])) {
                $filterDre = auth()->user()->dres->pluck('id')->join(',');
            }
            $campaigns = explode(',', request()->filter['campaign']);
            $dre = getDre()
                ->join('agencies as a', 'd.id', 'a.dre_id')
                ->join('missions as m', 'm.agency_id', 'a.id')
                ->whereIn('m.control_campaign_id', $campaigns)
                ->having(DB::raw('COUNT(m.id)'), '>', 0)
                ->get()
                ->map(fn ($item) => ['id' => $item->id, 'full_name' => $item->full_name])->toArray();
            $dre = formatForSelect($dre, 'full_name');
            if (!empty($filterDre)) {
                $dres = explode(',', $filterDre);
                $agency = getAgencies()->join('missions as m', 'm.agency_id', 'a.id');
                if (hasRole('ci')) {
                    $agency = $agency->where('m.assigned_to_ci_id', auth()->user()->id);
                } elseif (hasRole('cdc')) {
                    $agency = $agency;
                } else {
                    $agency = $agency->whereIn('dre_id', $dres);
                }

                $agency = $agency->having(DB::raw('COUNT(m.id)'), '>', 0)
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
            if (in_array(10, $values)) {
                $values = explode(',', str_replace(10, '4,5,6', implode(',', $values)));
            }
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
        if (isset($filter['is_late'])) {
            $value = $filter['is_late'] == 'Oui';
            $column = DB::raw(
                '(CASE
                    WHEN CAST(ISNULL(cdc_validation_at, GETDATE()) AS DATE) > CAST(programmed_end AS DATE) THEN 1
                    ELSE 0
                END)'
            );
            if (hasRole('ci')) {
                $column = DB::raw(
                    '(CASE
                        WHEN CAST(ISNULL(ci_validation_at, GETDATE()) AS DATE) > CAST(programmed_end AS DATE) THEN 1
                        ELSE 0
                    END)'
                );
            }
            $missions = $missions->having($column, $value);
        }
        return $missions;
    }
}
