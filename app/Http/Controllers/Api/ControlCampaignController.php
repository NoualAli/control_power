<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ControlCampaign\StoreRequest;
use App\Http\Requests\ControlCampaign\UpdateRequest;
use App\Http\Resources\ControlCampaignResource;
use App\Http\Resources\ProcessResource;
use App\Jobs\GenerateMissionReportPdf;
use App\Models\ControlCampaign;
use App\Models\Mission;
use App\Models\Process;
use App\Models\User;
use App\Notifications\ControlCampaign\Created;
use App\Notifications\ControlCampaign\Deleted;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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

        $campaigns = getControlCampaigns();

        if (!hasRole(['dcp', 'cdcr'])) {
            $campaigns = hasRole(['ci', 'cc']) ? $campaigns : $campaigns->whereNotNull('validated_at');
        }

        if ($sort) {
            $campaigns = $campaigns->sortByMultiple($sort);
        } else {
            $campaigns = $campaigns->orderBy('c.created_at', 'DESC');
        }

        if ($search) {
            $campaigns = $campaigns->search(['c.reference'], $search);
        }

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
    public function current()
    {
        isAbleOrAbort('view_control_campaign');
        return getControlCampaigns()->where('cc.is_not_for_testing')->orderBy('reference', 'DESC')->get()->last();
    }

    /**
     * Get a specific campaign
     */
    public function show(string $campaign)
    {
        isAbleOrAbort(['view_control_campaign']);
        $campaign = getControlCampaigns()->where('c.id', $campaign)->addSelect('c.description')->groupBy('c.description')->first();
        abort_if(!($campaign->validated_by_id || hasRole(['dcp', 'cdcr'])), 403, __('unauthorized'));

        if (request()->has('edit')) {
            $condition = $campaign->remaining_days_before_start > 5 || !$campaign->validated_by_id;
            abort_if(!$condition, 403, __('unauthorized'));
            $campaign->load('processes');
        }
        return $campaign;
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
            $data['validator_full_name'] = $isValidated ? auth()->user()->full_name : null;
            $data['creator_full_name'] = auth()->user()->full_name;
            $data['created_by_id'] = auth()->user()->id;
            $data['created_at'] = now()->format('Y-m-d H:i:s');
            $data['updated_at'] = now()->format('Y-m-d H:i:s');
            $data['reference'] = generateCDCRef($isValidated, $data['start_date'], $isForTesting);
            $data['id'] = \Illuminate\Support\Str::uuid();
            unset($data['pcf'], $data['is_validated']);
            $result = DB::transaction(function () use ($data, $processes, $isValidated, $isForTesting) {
                $campaign = DB::table('control_campaigns')->insert($data);
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
                    dd('validated !isFortesting');
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

                return $campaign && !in_array(false, $anyProcessesError);
            });
            return actionResponse($result, CREATE_SUCCESS, CREATE_ERROR);
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
            $data = $request->validated();
            $processes = $data['pcf'];
            $processes = pcfToProcesses($processes);
            unset($data['pcf'], $data['reference']);

            $result = DB::transaction(function () use ($campaign, $data, $processes) {
                $campaign->update($data);
                $campaign->processes()->sync($processes);
                return $campaign;
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
        abort_if($campaign->validated_by_id, 401);
        try {
            DB::transaction(function () use ($campaign) {
                $campaign->update(['validated_by_id' => auth()->user()->id, 'validator_full_name' => auth()->user()->full_name, 'validated_at' => now(), 'reference' => generateCDCRef(true, $campaign->start_date, $campaign->is_for_testing)]);
                $roles = ['cdc', 'cdrcp', 'dre', 'cdcr'];
                $users = User::whereRoles($roles)->get();
                foreach ($users as $user) {
                    Notification::send($user, new Created($campaign));
                }
            });
            return response()->json([
                'message' => 'Campagne de contrôle validée avec succès',
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return throwedError($th);
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
            $result = $campaign->delete();
            if ($campaign->validated_at) {
                $roles = ['cdc', 'cdrcp', 'dre'];
                if (!hasRole('cdcr')) {
                    $roles = ['cdc', 'cdrcp', 'dre', 'cdcr'];
                }
                $users = User::whereRoles($roles)->get();
                foreach ($users as $user) {
                    Notification::send($user, new Deleted($campaign));
                }
            }
            return actionResponse($result, DELETE_SUCCESS, DELETE_ERROR);
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
            if ($value == 'En attente de validation') {
                $campaigns = $campaigns->whereNull('c.validated_at');
            } elseif ($value == 'Validé') {
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
        return $campaigns;
    }
}