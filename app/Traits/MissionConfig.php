<?php

namespace App\Traits;

use App\Models\ControlCampaign;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait MissionConfig
{
    public function config()
    {
        $agencies = [];
        $campaigns = $this->loadCampaigns();
        $controllers = [];
        $headsOfMission = [];
        $currentCampaign = null;
        if (request()->has('campaign_id')) {
            /**
             * Load agencies informations ['id', 'full_name']
             * full_name = Agency Code + Agency Name
             */
            $agencies = $this->loadAgencies();
            $agencies = $agencies->flatten()->map(fn ($item) => ['id' => $item->id, 'full_name' => $item->full_name])->toArray();
            $agencies = formatForSelect($agencies, 'full_name');
            $currentCampaign = $this->loadCampaign();
        } else {
            $campaigns = $this->loadCampaigns();
        }

        if (request()->has('programmed_start') && request()->has('programmed_end') && request()->has('campaign_id')) {
            $headsOfMission = $this->loadHeadsOfMission();
        }

        if (request()->has('programmed_start') && request()->has('programmed_end') && request()->has('campaign_id') && request()->has('head_of_mission_id')) {
            $controllers = $this->loadControllers();
        }

        if (request()->has('programmed_start') && request()->has('programmed_end') && request()->has('campaign_id') && request()->has('mission_id')) {
            $mission = $this->loadMission();
        }
        // dd(compact('agencies', 'campaigns', 'campaign', 'headsOfMission', 'controllers'));
        return compact('agencies', 'campaigns', 'currentCampaign', 'headsOfMission', 'controllers');
    }
    /**
     * Fetch user agencies id's as array
     * @return array
     */
    private function getUserAgencies()
    {
        return auth()->user()->agencies->pluck('id')->toArray();
    }
    public function loadAgencies()
    {
        isAbleOrAbort(['create_missions', 'edit_mission']);
        $campaign = request('campaign_id');
        $missionAgencies = $this->loadMissions($campaign)->get()->pluck('agency_id')->toArray();
        $agencies = DB::table('agencies as a')
            ->selectRaw("CONCAT(a.code, ' - ', a.name) as full_name, a.id")
            ->whereIn('a.id', $this->getUserAgencies())
            ->whereNotIn('a.id', $missionAgencies)
            ->leftJoin('missions as m', 'm.agency_id', 'a.id')
            ->get();
        return $agencies;
    }


    /**
     * Load missions attached to secified campaign in request param
     *
     * @return Object
     */
    public function loadMissions()
    {

        $campaign = request('campaign_id');
        $missions = DB::table('missions')->where('control_campaign_id', $campaign)->whereNull('deleted_at');
        if (request()->has('mission_id') && request('mission_id')) {
            $missions = $missions->whereNot('id', request('mission_id'));
        }
        return $missions;
    }

    /**
     * Load specified mission from request param
     *
     * @return Object|Bool
     */
    public function loadMission()
    {
        if (request()->has('mission_id') && request('mission_id')) {
            return DB::table('missions')->where('id', request('mission_id'))->whereNull('deleted_at')->first();
        }
        return false;
    }
    /**
     * Display config.
     *
     * @return \Illuminate\Http\Response
     */
    // public function config()
    // {
    //     isAbleOrAbort(['create_missions', 'edit_mission']);
    //     $agencies = [];
    //     $controllers = [];
    //     $headsOfMission = [];
    //     $campaigns = DB::table('control_campaigns as cc');
    //     abort_if(!$campaigns->count(), 423, 'Aucune campagne de contrôle n\'existe encore');
    //     $currentCampaign = $this->loadCampaign();
    //     $currentCampaign->remaining_days_before_start_str = daysRemainingStr($currentCampaign->remaining_days_before_start, $currentCampaign->remaining_days_before_end);
    //     $currentCampaign->remaining_days_before_end_str = daysRemainingStr($currentCampaign->remaining_days_before_end);

    //     abort_if(!$currentCampaign->validated_by_id, 403);
    //     $campaigns = $this->loadCampaigns();

    //     if (request()->has('campaign_id')) {
    //         $user = auth()->user();
    //         $missionId = request('mission_id');
    //         $missions = DB::table('missions as m')->whereNull('m.deleted_at')->where('control_campaign_id', $currentCampaign->id);
    //         if ($missionId) {
    //             $missions = $missions->where('m.id', '!=', $missionId);
    //         }
    //         $missions = $missions->get();

    //         $missionsAgency = (clone $missions)->pluck('agency_id')->toArray();

    //         $agencies = DB::table('agencies as a')->select(
    //             'a.id',
    //             DB::raw("CONCAT(a.code, ' - ', a.name) as full_name")
    //         )
    //             ->leftJoin('user_has_agencies as uha', 'a.id', 'uha.agency_id')
    //             ->where('uha.user_id', $user->id)->get();

    //         $controllers = DB::table('users as u')->select('u.id', 'u.username')
    //             ->leftJoin('user_has_agencies as uha', 'u.id', 'uha.user_id')
    //             ->leftJoin('roles as r', 'u.active_role_id', 'r.id')
    //             ->whereIn('uha.agency_id', (clone $agencies)->pluck('id')->toArray())
    //             ->where('r.code', 'ci')
    //             ->groupBy('u.id', 'u.username')
    //             ->where('u.is_active', true)
    //             ->get();

    //         // Format controllers array before serve
    //         $controllers = $controllers->filter(function ($user) {
    //             return $user->id !== auth()->user()->id;
    //         })->flatten()->map(fn ($controller) => ['id' => $controller->id, 'full_name' => normalizeFullName(getUserFullNameWithRole($controller->id, false))])->unique('id');
    //         $controllers = formatForSelect((clone $controllers)->toArray(), 'full_name');

    //         // Format agencies array before serve
    //         $agencies = (clone $agencies)->filter(function ($agency) use ($missionsAgency) {
    //             return !in_array($agency?->id, $missionsAgency);
    //         })->flatten()->map(fn ($item) => ['id' => $item->id, 'full_name' => $item->full_name])->toArray();

    //         $agencies = formatForSelect($agencies, 'full_name');
    //     }
    //     if (request('head_of_mission_id')) {
    //         $agencies = DB::table('agencies as a')->select(
    //             'a.id',
    //             DB::raw("CONCAT(a.code, ' - ', a.name) as full_name")
    //         )
    //             ->leftJoin('user_has_agencies as uha', 'a.id', 'uha.agency_id')
    //             ->where('uha.user_id', request('head_of_mission_id'))->get();
    //         $assistants = DB::table('users as u')->select('u.id', 'u.username')
    //             ->leftJoin('user_has_agencies as uha', 'u.id', 'uha.user_id')
    //             ->leftJoin('roles as r', 'u.active_role_id', 'r.id')
    //             ->whereIn('uha.agency_id', (clone $agencies)->pluck('id')->toArray())
    //             ->where('r.code', 'ci')
    //             ->groupBy('u.id', 'u.username')
    //             ->where('u.is_active', true)
    //             ->get();
    //         $assistants = $assistants->filter(fn ($controller) => $controller->id !== request('head_of_mission_id'))
    //             ->flatten()->map(fn ($assistant) => ['id' => $assistant->id, 'full_name' => normalizeFullName(getUserFullNameWithRole($assistant->id, false))])->unique('id');;
    //         return formatForSelect($assistants->toArray(), 'full_name');
    //     }
    //     return compact('agencies', 'campaigns', 'controllers', 'currentCampaign');
    // }

    /**
     * Fetch list of campaigns
     *
     * @return Array
     */
    public function loadCampaigns()
    {
        $campaigns = getControlCampaigns()->select('c.reference', 'c.id')
            ->whereDate('end_date', '>=', today()->format('Y-m-d'))
            ->whereNotNull('validated_by_id')
            ->orderBy('reference', 'DESC')
            ->get()
            ->map(fn ($item) => ['reference' => $item->reference, 'id' => $item->id])
            ->toArray();
        $campaigns = formatForSelect($campaigns, 'reference');
        return $campaigns;
    }

    /**
     * Fetch specified campaign by id
     *
     * @return Object
     */
    public function loadCampaign()
    {
        $currentCampaign = getControlCampaigns()->where('c.is_for_testing', false)->whereNotNull('validated_at')->whereNull('c.deleted_at');
        if (request('campaign_id')) {
            $currentCampaign = $currentCampaign->select([
                'c.reference',
                'c.description',
                'c.start_date',
                'c.end_date',
                DB::raw('DATEDIFF(day, CAST(GETDATE() AS DATE), start_date) as remaining_days_before_start'),
                DB::raw('DATEDIFF(day, CAST(GETDATE() AS DATE), end_date) as remaining_days_before_end')
            ])->groupBy(['c.reference', 'c.id', 'c.description', 'c.start_date', 'c.end_date'])->where('c.id', request('campaign_id'))->get()->first();
            $currentCampaign->remaining_days_before_end_str = daysRemainingStr($currentCampaign->remaining_days_before_end);
            $currentCampaign->remaining_days_before_start_str = daysRemainingStr($currentCampaign->remaining_days_before_start, $currentCampaign->remaining_days_before_end);
            $currentCampaign->end_date = Carbon::parse($currentCampaign->end_date)->format('d-m-Y');
            $currentCampaign->start_date = Carbon::parse($currentCampaign->start_date)->format('d-m-Y');
        } else {
            $currentCampaign = $currentCampaign->select(['c.description', 'c.start_date', 'c.end_date'])->groupBy(['c.id', 'c.description', 'c.start_date', 'c.end_date'])->orderBy('reference', 'ASC')->get()->first();
        }

        return $currentCampaign;
    }


    /**
     * Fetch list of available controllers
     *
     * @return Array
     */
    public function loadControllers()
    {
        isAbleOrAbort(['create_missions', 'edit_mission']);
        $missions = $this->loadMissions()->get();
        $ciMissions = DB::table('missions as m')->join('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id')->whereNull('m.deleted_at');
        if (request('mission_id')) {
            $ciMissions = $ciMissions->whereNot('id', request('mission_id'));
        }
        $controllers = DB::table('users as u')->select('u.id', 'u.username')
            ->leftJoin('user_has_agencies as uha', 'u.id', 'uha.user_id')
            ->leftJoin('roles as r', 'u.active_role_id', 'r.id')
            ->whereIn('uha.agency_id', $this->loadAgencies()->pluck('id')->toArray())
            ->where('r.code', 'ci')
            ->groupBy('u.id', 'u.username')
            ->where('u.is_active', true)
            ->where('u.id', '!=', request('head_of_mission_id'))
            ->where('u.id', '!=', auth()->user()->id);

        if (request()->has('head_of_mission_id') && request('head_of_mission_id')) {
            $controllers = $controllers->where('u.id', '!=', request('head_of_mission'));
        }

        if (request()->has('assistants') && request('assistants')) {
            $controllers = $controllers->whereNotIn('u.id', request('assistants'));
        }

        $controllers = $controllers->get();

        if (request()->has('programmed_end') && request()->has('programmed_start') && request('programmed_end') && request('programmed_start')) {
            $missions = $missions->filter(function ($mission) {
                $startDate = Carbon::parse($mission->programmed_start)->format('Y-m-d');
                $endDate = Carbon::parse($mission->programmed_end)->format('Y-m-d');
                if ($mission->real_end) {
                    $endDate = $mission->real_end;
                }
                if (request('programmed_start') && request('programmed_end')) {
                    return Carbon::parse($startDate)->betweenIncluded(request('programmed_start'), request('programmed_end')) || Carbon::parse($endDate)->betweenIncluded(request('programmed_start'), request('programmed_end'));
                }
                return false;
            });
            $controllers = $controllers->filter(function ($headOfMission) use ($missions, $ciMissions) {
                $headOfMissionId = (int) $headOfMission->id;
                $controllersId = $missions->pluck('assigned_to_ci_id')->toArray();
                $hasMissions = !in_array($headOfMissionId, $controllersId);
                $ciMissions = (clone $ciMissions)->where('user_id', $headOfMissionId)->get();
                $ciMissions = $ciMissions->filter(function ($mission) {
                    $startDate = Carbon::parse($mission->programmed_start)->format('Y-m-d');
                    $endDate = Carbon::parse($mission->programmed_end)->format('Y-m-d');
                    if ($mission->real_end) {
                        $endDate = $mission->real_end;
                    }
                    if (request('programmed_start') && request('programmed_end')) {
                        return Carbon::parse($startDate)->betweenIncluded(request('programmed_start'), request('programmed_end')) || Carbon::parse($endDate)->betweenIncluded(request('programmed_start'), request('programmed_end'));
                    }
                    return false;
                });
                return $hasMissions && !$ciMissions->count();
            });
        }
        $controllers = $controllers->flatten()->map(fn ($controller) => ['id' => $controller->id, 'full_name' => normalizeFullName(getUserFullNameWithRole($controller->id, false))])->unique('id');
        $controllers = formatForSelect((clone $controllers)->toArray(), 'full_name');
        // dd($controllers);
        return $controllers;
    }

    /**
     * Fetch list of available heads of mission
     *
     * @return Array
     */
    public function loadHeadsOfMission()
    {
        isAbleOrAbort(['create_missions', 'edit_mission']);
        $missions = $this->loadMissions()->get();
        $ciMissions = DB::table('missions as m')->join('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id')->whereNull('m.deleted_at');
        if (request('mission_id')) {
            $ciMissions = $ciMissions->whereNot('id', request('mission_id'));
        }
        $headsOfMission = DB::table('users as u')->select('u.id', 'u.username')
            ->leftJoin('user_has_agencies as uha', 'u.id', 'uha.user_id')
            ->leftJoin('roles as r', 'u.active_role_id', 'r.id')
            ->whereIn('uha.agency_id', $this->loadAgencies()->pluck('id')->toArray())
            ->where('r.code', 'ci')
            ->groupBy('u.id', 'u.username')
            ->where('u.is_active', true)
            ->where('u.id', '!=', auth()->user()->id);

        if (request()->has('head_of_mission_id') && request('head_of_mission_id')) {
            $headsOfMission = $headsOfMission->where('u.id', '!=', request('head_of_mission'));
        }

        if (request()->has('assistants') && request('assistants')) {
            $headsOfMission = $headsOfMission->whereNotIn('u.id', request('assistants'));
        }

        $headsOfMission = $headsOfMission->get();
        if (request()->has('programmed_end') && request()->has('programmed_start') && request('programmed_end') && request('programmed_start')) {
            $missions = $missions->filter(function ($mission) {
                $startDate = Carbon::parse($mission->programmed_start)->format('Y-m-d');
                $endDate = Carbon::parse($mission->programmed_end)->format('Y-m-d');
                if ($mission->real_end) {
                    $endDate = $mission->real_end;
                }
                if (request('programmed_start') && request('programmed_end')) {
                    return Carbon::parse($startDate)->betweenIncluded(request('programmed_start'), request('programmed_end')) || Carbon::parse($endDate)->betweenIncluded(request('programmed_start'), request('programmed_end'));
                }
                return false;
            });
            $headsOfMission = $headsOfMission->filter(function ($headOfMission) use ($missions, $ciMissions) {
                $headOfMissionId = (int) $headOfMission->id;
                $headsOfMissionId = $missions->pluck('assigned_to_ci_id')->toArray();
                $hasMissions = !in_array($headOfMissionId, $headsOfMissionId);
                $ciMissions = (clone $ciMissions)->where('user_id', $headOfMissionId)->get();
                $ciMissions = $ciMissions->filter(function ($mission) {
                    $startDate = Carbon::parse($mission->programmed_start)->format('Y-m-d');
                    $endDate = Carbon::parse($mission->programmed_end)->format('Y-m-d');
                    if ($mission->real_end) {
                        $endDate = $mission->real_end;
                    }
                    if (request('programmed_start') && request('programmed_end')) {
                        return Carbon::parse($startDate)->betweenIncluded(request('programmed_start'), request('programmed_end')) || Carbon::parse($endDate)->betweenIncluded(request('programmed_start'), request('programmed_end'));
                    }
                    return false;
                });
                return $hasMissions && !$ciMissions->count();
            });
        }
        $headsOfMission = $headsOfMission->flatten()->map(fn ($controller) => ['id' => $controller->id, 'full_name' => normalizeFullName(getUserFullNameWithRole($controller->id, false))])->unique('id');
        $headsOfMission = formatForSelect((clone $headsOfMission)->toArray(), 'full_name');
        return $headsOfMission;
    }
}