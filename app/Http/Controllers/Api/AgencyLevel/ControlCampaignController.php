<?php

namespace App\Http\Controllers\Api\AgencyLevel;

use App\DB\Queries\ControlCampaignQuery;
use App\Enums\EventLogTypes;
use App\Http\Controllers\Controller;
use App\Http\Requests\ControlCampaign\StoreRequest;
use App\Http\Requests\ControlCampaign\UpdateRequest;
use App\Http\Resources\ControlCampaignResource;
use App\Http\Resources\ProcessResource;
use App\Jobs\GenerateMissionReportPdf;
use App\Models\ControlCampaign;
use App\Models\EventLog;
use App\Models\Media;
use App\Models\Mission;
use App\Models\Process;
use App\Models\User;
use App\Notifications\ControlCampaign\Created;
use App\Notifications\ControlCampaign\Deleted;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class ControlCampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        isAbleOrAbort(['view_control_campaign', 'view_control_campaign', 'create_mission', 'edit_mission']);
        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request()->has('fetchAll');
        $searchColumns = ['c.reference', 'c.creator_full_name', 'c.validator_full_name'];
        $campaigns = (new ControlCampaignQuery())->prepare([
            'sort' => ['sort' => $sort, 'default' => ['c.created_at' => 'DESC']],
            'search' => ['columns' => $searchColumns, 'value' => $search],
        ])->multiple();

        if ($filter) {
            $campaigns = $this->filter($campaigns, $filter);
        }

        if ($fetchAll) {
            $campaigns = formatForSelect($campaigns->get()->toArray(), 'reference');
        } else {
            $campaigns = ControlCampaignResource::collection($campaigns->paginate($perPage)->onEachSide(1));
        }
        return $campaigns;
    }

    /**
     * Display current campaign
     */
    public function campaign()
    {
        isAbleOrAbort('view_control_campaign');
        $latest = request()->has('latest');
        $current = request()->has('current');

        if ($latest) {
            $campaign = DB::table('control_campaigns as cc')->where('cc.is_for_testing', false)->whereNull('cc.deleted_at')->orderBy('cc.start_date', 'ASC');
        } elseif ($current) {
            $campaign = DB::table('control_campaigns as cc')->where('cc.is_for_testing', false)->whereNull('cc.deleted_at');
            $today = today();
            $campaign =  $campaign->where(function ($query) use ($today) {
                $query->whereDate('start_date', '<=', $today)
                    ->whereDate('end_date', '>=', $today)
                    ->orWhere(function ($query) use ($today) {
                        // Handle cases where start_date is in the future but end_date is today
                        $query->whereDate('start_date', '>=', $today)
                            ->whereDate('end_date', '=', $today);
                    });
            })->orderBy('cc.start_date', 'ASC');
            if (!$campaign->count()) {
                $campaign = $campaign = DB::table('control_campaigns as cc')->where('cc.is_for_testing', false)->whereNull('cc.deleted_at')->whereNotNull('validated_at')->whereDate('end_date', '<=', $today)->orderBy('cc.start_date', 'ASC');
            }
        }
        $campaign = $campaign->get()->last();
        return $campaign;
    }

    /**
     * Get a specific campaign
     */
    public function show(string $campaign)
    {
        isAbleOrAbort(['view_control_campaign']);
        $campaign = getControlCampaigns()->having('c.id', $campaign)->addSelect('c.description')->groupBy('c.description')->first();
        if ($campaign) {
            $campaign->synthesis = getMediaByForeign(ControlCampaign::class, $campaign?->id, 'uploads/Synthèses')->get();
        }
        if ($campaign) {
            abort_if(!($campaign->validated_by_id || hasRole(['dcp', 'cdcr'])), 403, __('unauthorized'));

            if (request()->has('edit')) {
                $condition = !boolval(intval($campaign->is_validated));
                abort_if(!$condition, 403, __('unauthorized'));

                $campaign->processes = getControlCampaignProcesses($campaign)->get();
            }
            return $campaign;
        } else {
            return actionResponse(false, '', "La campaign que vous tantez d'afficher n'existe pas.", 404);
        }
    }

    /**
     * Get next reference for campaign
     */
    public function getNextReference()
    {
        isAbleOrAbort('create_control_campaign');
        return generateCDCRef(request()->has('is_validated'), null, request()->has('is_for_testing'));
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
            $processes = pcfToProcesses($data['pcf']);
            $isValidated = isset($data['is_validated']) && boolval($data['is_validated']);
            $isForTesting = isset($data['is_for_testing']) && boolval($data['is_for_testing']);
            $data['validated_by_id'] = $isValidated ? auth()->user()->id : null;
            $data['validated_at'] = $isValidated ? now() : null;
            $data['validator_full_name'] = $isValidated ? getUserFullNameWithRole() : null;
            $data['creator_full_name'] = getUserFullNameWithRole();
            $data['created_by_id'] = auth()->user()->id;
            $data['created_at'] = now()->format('Y-m-d H:i:s');
            $data['updated_at'] = now()->format('Y-m-d H:i:s');
            $data['reference'] = generateCDCRef($isValidated, $data['start_date'], $isForTesting);
            $data['id'] = \Illuminate\Support\Str::uuid();
            unset($data['pcf'], $data['is_validated']);

            $result = DB::transaction(function () use ($data, $processes, $isValidated, $isForTesting) {
                $campaign = DB::table('control_campaigns')->insert($data);
                $eventType = EventLogTypes::CREATE;
                if ($isValidated) {
                    $eventType = EventLogTypes::CREATE_VALIDATE;
                }
                EventLog::store(['type' => $eventType, 'attachable_type' => ControlCampaign::class, 'attachable_id' => $data['id']]);
                $anyProcessesError = [];
                foreach ($processes as $process) {
                    $insertedProcess = DB::table('control_campaign_processes')->insert([
                        'process_id' => $process,
                        'control_campaign_id' => $data['id'],
                    ]);
                    array_push($anyProcessesError, $insertedProcess);
                }

                if ($isValidated && !$isForTesting) {
                    $roles = ['cdc', 'cdrcp', 'dre', 'cdcr', 'der'];
                    $users = User::whereRoles($roles)->isNotForTesting()->isActive()->get();
                    $campaignORM = ControlCampaign::findOrFail($data['id']);
                    foreach ($users as $user) {
                        Notification::send($user, new Created($campaignORM));
                    }
                } else {
                    if (hasRole('cdcr') && !$isForTesting) {
                        $users = User::whereRoles(['dcp'])->isNotForTesting()->isActive()->get();
                        foreach ($users as $user) {
                            Notification::send($user, new Created($data['id']));
                        }
                    }
                }
                $anyProcessesError = !in_array(false, $anyProcessesError);
                return compact("campaign", "anyProcessesError");
            });
            return actionResponse($result['campaign'], "La campagne de contrôle <b>" . $data['reference'] . "</b> a été planifiée avec succès", CREATE_ERROR);
        } catch (\Throwable $th) {
            return throwedError($th);
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
            $oldCampaign = clone $campaign;
            $data = $request->validated();
            $processes = $data['pcf'];
            $processes = pcfToProcesses($processes);
            unset($data['pcf'], $data['reference']);
            $result = DB::transaction(function () use ($campaign, $data, $processes, $oldCampaign) {
                $result = $campaign->update($data);
                EventLog::store(['type' => EventLogTypes::UPDATE, 'attachable_type' => ControlCampaign::class, 'attachable_id' => $campaign->id, 'payload' => ['old' => $oldCampaign, 'new' => $campaign]]);
                $campaign->processes()->sync($processes);
                return $result;
            });

            return actionResponse($result, UPDATE_SUCCESS, UPDATE_ERROR);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    public function generateReports(string $campaign)
    {
        $all = boolVal(intVal(request('all', false)));

        $missions = Mission::where('control_campaign_id', $campaign)->get();
        // dd($all, $missions);
        foreach ($missions as $mission) {
            if ($all) {
                GenerateMissionReportPdf::dispatch($mission);
            } else {
                if (!$mission->pdf_report_exists) {
                    GenerateMissionReportPdf::dispatch($mission);
                }
            }
        }
        return response()->json([
            'status' => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Models\ControlCampaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function validateCampaign(ControlCampaign $campaign)
    {
        isAbleOrAbort('validate_control_campaign');
        try {
            $result = false;
            $code = 200;
            $successMessage = '';
            $errorMessage = DEFAULT_ERROR_MESSAGE;
            $notValidatedCampaigns = DB::table('control_campaigns as cc')
                ->whereDate('end_date', '<', $campaign->start_date)
                ->whereNull('deleted_at')
                ->whereNull('validated_at')
                ->where('id', '!=', $campaign->id)
                ->orderBy('start_date')
                ->pluck('reference');
            $totalCampaigns = $notValidatedCampaigns->count();
            if (!$totalCampaigns) {
                if (!$campaign->is_validated) {
                    if ($campaign->processes->count()) {
                        $result = DB::transaction(function () use ($campaign) {
                            $result = $campaign->update(['validated_by_id' => auth()->user()->id, 'validator_full_name' => getUserFullNameWithRole(), 'validated_at' => now(), 'reference' => generateCDCRef(true, $campaign->start_date, $campaign->is_for_testing)]);
                            EventLog::store(['type' => EventLogTypes::VALIDATE, 'attachable_type' => ControlCampaign::class, 'attachable_id' => $campaign->id, 'payload' => ['success' => $result]]);
                            $roles = ['cdc', 'cdrcp', 'dre', 'cdcr'];
                            $users = User::whereRoles($roles)->get();
                            foreach ($users as $user) {
                                Notification::send($user, new Created($campaign));
                            }
                            return $result;
                        });
                        if ($result) {
                            $successMessage = "Campagne de contrôle $campaign->reference validée avec succès!";
                        }
                    } else {
                        $errorMessage = "La campagne de contrôle $campaign->reference ne peut être validée sans processus.";
                        $code = 423;
                        EventLog::store(['type' => EventLogTypes::VALIDATE, 'attachable_type' => ControlCampaign::class, 'attachable_id' => $campaign->id, 'payload' => ['success' => false, 'content' => $errorMessage]]);
                    }
                } else {
                    $errorMessage = "La campagne de contrôle $campaign->reference est déjà validée.";
                    $code = 423;
                    EventLog::store(['type' => EventLogTypes::VALIDATE, 'attachable_type' => ControlCampaign::class, 'attachable_id' => $campaign->id, 'payload' => ['success' => false, 'content' => $errorMessage]]);
                }
            } else {
                $errorMessage = 'Il est nécessaire de valider';
                $errorMessage .= $totalCampaigns > 1 ? ' les campagnes de contrôle ' : ' la campagne de contrôle ';
                $errorMessage .= '<b>' . $notValidatedCampaigns->join(', ') . '</b> avant de pouvoir valider la campagne de contrôle <b>' . $campaign->reference . '</b>.';
                $code = 423;
                EventLog::store(['type' => EventLogTypes::VALIDATE, 'attachable_type' => ControlCampaign::class, 'attachable_id' => $campaign->id, 'payload' => ['success' => false, 'content' => $errorMessage]]);
            }
            return actionResponse($result, $successMessage, $errorMessage, $code);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $campaign)
    {
        $campaign = getControlCampaigns(null, $campaign);
        $canDelete = !boolVal(intVal($campaign->is_validated));
        if (!hasRole('dcp')) {
            $canDelete = !$campaign->is_validated && $campaign->created_by_id == auth()->user()->id;
        }
        try {
            if ($canDelete) {
                $result = DB::table('control_campaigns')->where('id', $campaign->id)->delete();
                EventLog::store(['type' => EventLogTypes::DELETE, 'attachable_type' => ControlCampaign::class, 'attachable_id' => $campaign->id, 'payload' => ['success' => $result]]);
                if ($campaign->validated_at && !config('mail.disabled')) {
                    $roles = ['cdc', 'cdrcp', 'dre'];
                    if (!hasRole('cdcr')) {
                        $roles = ['cdc', 'cdrcp', 'dre', 'cdcr'];
                    }
                    $users = User::whereRoles($roles)->get();
                    foreach ($users as $user) {
                        Notification::send($user, new Deleted($campaign->id));
                    }
                }
                return actionResponse($result, DELETE_SUCCESS, DELETE_ERROR);
            } else {
                $errorMessage = "Cette campagne de contrôle ne peut pas être supprimée car elle est validée.";
                EventLog::store(['type' => EventLogTypes::DELETE, 'attachable_type' => ControlCampaign::class, 'attachable_id' => $campaign->id, 'payload' => ['success' => false, 'content' => $errorMessage]]);
                return actionResponse(false, DELETE_SUCCESS, $errorMessage, 422);
            }
        } catch (\Throwable $th) {
            return throwedError($th);
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
        isAbleOrAbort('edit_control_campaign');
        try {
            $result = $campaign->processes()->detach($process);
            EventLog::store(['type' => EventLogTypes::DETACH, 'attachable_type' => ControlCampaign::class, 'attachable_id' => $campaign->id, 'payload' => ['success' => $result, 'content' => 'Detach processes']]);
            return actionResponse($result, DETACH_SUCCESS, DETACH_ERROR);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    /**
     * Get campaign processes list
     */
    public function processes(string $campaign)
    {
        $campaign = getControlCampaigns()->where('c.id', $campaign)->select(['c.id', DB::raw('(CASE WHEN c.validated_at IS NOT NULL THEN 1 ELSE 0 END) AS is_validated')])->first();

        abort_if(!($campaign->is_validated || hasRole(['dcp', 'cdcr'])), 401, __('unauthorized'));

        $processes = getControlCampaignProcesses($campaign);
        $search = request('search', false);
        $perPage = request('perPage', 10);

        if ($search) {
            $processes = $processes->search(['p.name', 'd.name', 'f.name'], $search);
        }

        return ProcessResource::collection($processes->paginate($perPage)->onEachSide(1));
    }


    /**
     * Filter data
     *
     * @param Builder $campaigns
     * @param array $filter
     *
     * @return Builder
     */
    public function filter(Builder $campaigns, array $filter): Builder
    {
        if (isset($filter['validated'])) {
            $value = $filter['validated'];
            if ($value == 'En attente') {
                $campaigns = $campaigns->whereNull('c.validated_at');
            } elseif ($value == 'Validée') {
                $campaigns = $campaigns->whereNotNull('c.validated_at');
            } else {
                abort(422, "La valeur " . $value . " n'est pas une valeur valide.");
            }
        }
        if (isset($filter['test'])) {
            $value = $filter['test'];
            if ($value == 'Non') {
                $campaigns = $campaigns->where('c.is_for_testing', false);
            } elseif ($value == 'Oui') {
                $campaigns = $campaigns->where('c.is_for_testing', true);
            } else {
                abort(422, "La valeur " . $value . " n'est pas une valeur valide.");
            }
        }
        if (isset($filter['start'])) {
            $start = isset($filter['start']) ? $filter['start'] : null;
            $campaigns = $campaigns->whereDate('c.start_date', '>=', $start);
        }

        if (isset($filter['end'])) {
            $end = isset($filter['end']) ? $filter['end'] : null;
            $campaigns = $campaigns->whereDate('c.end_date', '<=', $end);
        }
        return $campaigns;
    }
}
