<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ControlCampaign\StoreRequest;
use App\Http\Requests\ControlCampaign\UpdateRequest;
use App\Http\Resources\ControlCampaignResource;
use App\Http\Resources\ProcessResource;
use App\Models\ControlCampaign;
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
        return ControlCampaign::orderBy('created_at', 'ASC')->get()->last();
    }

    /**
     * Get a specific campaign
     */
    public function show(int $campaign)
    {
        isAbleOrAbort(['view_control_campaign']);
        $campaign = getControlCampaigns()->where('c.id', $campaign)->addSelect('c.description')->groupBy('c.description')->first();
        abort_if(!($campaign->validated_by_id || hasRole(['dcp', 'cdcr'])), 403, __('unauthorized'));
        // dd(getControlCampaigns()->where('c.id', $campaign->id)->addSelect('c.description')->groupBy('c.description')->first());
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
        return generateCDCRef();
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
            $data['validated_by_id'] = isset($data['validate']) && boolval($data['validate']) ? auth()->user()->id : null;
            $data['validated_at'] = isset($data['validate']) && boolval($data['validate']) ? now() : null;
            $data['validator_full_name'] = isset($data['validate']) && boolval($data['validate']) ? auth()->user()->full_name : null;
            $data['creator_full_name'] = auth()->user()->full_name;
            $data['reference'] = generateCDCRef($data['validate'], $data['start_date']);
            unset($data['pcf'], $data['validate']);
            $campaign = DB::transaction(function () use ($data, $processes) {
                $campaign = auth()->user()->campaigns()->create($data);

                foreach ($processes as $process) {
                    $campaign->processes()->attach($process);
                }
                if ($campaign->validated_by_id) {
                    $roles = ['cdc', 'cdrcp', 'dre', 'cdcr'];
                    $users = User::whereRoles($roles)->get();
                    foreach ($users as $user) {
                        Notification::send($user, new Created($campaign));
                    }
                } else {
                    if (hasRole('cdcr')) {
                        $users = User::whereRoles(['dcp'])->get();
                        foreach ($users as $user) {
                            Notification::send($user, new Created($campaign));
                        }
                    }
                }

                return $campaign;
            });

            return response()->json([
                'message' => 'Campagne de contrôle créé avec succès',
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], 500);
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

            DB::transaction(function () use ($campaign, $data, $processes) {
                $campaign->update($data);
                $campaign->processes()->sync($processes);
            });


            return response()->json([
                'message' => UPDATE_SUCCESS,
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], 500);
        }
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
                $campaign->update(['validated_by_id' => auth()->user()->id, 'validator_full_name' => auth()->user()->full_name, 'validated_at' => now(), 'reference' => generateCDCRef(true, $campaign->start_date)]);
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
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], 500);
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
                return response()->json([
                    'message' => 'Campagne de contrôle supprimer avec succès',
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
                'status' => false
            ], 500);
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
            if ($campaign->processes()->detach($process)) {
                return response()->json([
                    'message' => 'Processus détaché avec succès',
                    'status' => true,
                ]);
            }
            return response()->json([
                'message' => DETACH_ERROR,
                'status' => false,
            ]);
        } catch (\Throwable $th) {


            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], 500);
        }
    }

    /**
     * Get campaign processes list
     */
    public function processes(int $campaign)
    {
        $campaign = getControlCampaigns()->where('c.id', $campaign)->select(['c.id', DB::raw('(CASE WHEN c.validated_at IS NOT NULL THEN 1 ELSE 0 END) AS is_validated')])->first();

        abort_if(!($campaign->is_validated || hasRole(['dcp', 'cdcr'])), 401, __('unauthorized'));

        $processes = getControlCampaignProcesses($campaign);
        $search = request('search', false);
        // $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);

        // if ($fetchFilters) {
        //     return $this->processesFilters($processes);
        // }
        if ($search) {
            $processes = $processes->search(['p.name', 'd.name', 'f.name'], $search);
        }

        return ProcessResource::collection($processes->paginate($perPage)->onEachSide(1));
    }

    private function processesFilters($processes)
    {
        // dd($processes);
        $family = $processes->relationUniqueData('family');
        $domain = $processes->relationUniqueData('domain');
        // dd(compact('family', 'domain'));
        return compact('family', 'domain');
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
        if (isset($filter['validated'])) {
            $value = $filter['validated'];
            if ($value == 'En attente de validation') {
                $missions = $missions->whereNull('validated_at');
            } elseif ($value == 'Validé') {
                $missions = $missions->whereNotNull('validated_at');
            } else {
                abort(422, "La valeur " . $value . " n'est pas une valeur valide.");
            }
        }
        return $missions;
    }
}
