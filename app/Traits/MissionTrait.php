<?php

namespace App\Traits;

use App\DB\Queries\ControlCampaignQuery;
use App\Enums\MissionState;
use App\Jobs\GenerateMissionReportPdf;
use App\Models\ControlCampaign;
use App\Models\Mission;
use App\Models\Structures\Agency;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait MissionTrait
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
            ->groupBy('a.code', 'a.name', 'a.id')
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
        $missions = DB::table('missions')->where('control_campaign_id', $campaign);
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
            return DB::table('missions')->where('id', request('mission_id'))->first();
        }
        return false;
    }

    /**
     * Fetch list of campaigns
     *
     * @return Array
     */
    public function loadCampaigns()
    {
        $campaigns = (new ControlCampaignQuery)->prepare()->query->select('cc.reference', 'cc.id')
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
        $currentCampaign = (new ControlCampaignQuery)->prepare()->query->whereNotNull('validated_at');
        if (request('campaign_id')) {
            $currentCampaign = $currentCampaign->select([
                'cc.reference',
                'cc.description',
                'cc.start_date',
                'cc.end_date',
                DB::raw('DATEDIFF(day, CAST(GETDATE() AS DATE), start_date) as remaining_days_before_start'),
                DB::raw('DATEDIFF(day, CAST(GETDATE() AS DATE), end_date) as remaining_days_before_end')
            ])->groupBy(['cc.reference', 'cc.id', 'cc.description', 'cc.start_date', 'cc.end_date'])->where('cc.id', request('campaign_id'))->get()->first();
            $currentCampaign->remaining_days_before_end_str = daysRemainingStr($currentCampaign->remaining_days_before_end);
            $currentCampaign->remaining_days_before_start_str = daysRemainingStr($currentCampaign->remaining_days_before_start, $currentCampaign->remaining_days_before_end);
            $currentCampaign->end_date = Carbon::parse($currentCampaign->end_date)->format('d-m-Y');
            $currentCampaign->start_date = Carbon::parse($currentCampaign->start_date)->format('d-m-Y');
        } else {
            $currentCampaign = $currentCampaign->select(['cc.description', 'cc.start_date', 'cc.end_date'])->groupBy(['cc.id', 'cc.description', 'cc.start_date', 'cc.end_date'])->orderBy('reference', 'ASC')->get()->first();
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
        $ciMissions = DB::table('missions as m')->join('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id');
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
        $ciMissions = DB::table('missions as m')->join('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id');
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
        $campaignProcesses = $campaignProcesses->filter(function ($process) use ($categoryProcesses) {
            return in_array($process->id, $categoryProcesses); // garder que les processus utilisés par la catégorie
        })->pluck('control_points')->flatten()->pluck('id')->map(function ($controlPoint) use ($assigned_to, $missionReference) {
            $controlPoint = getControlPoints()
                ->where('cp.id', $controlPoint)
                ->where('f.is_active', true)
                ->where('d.is_active', true)
                ->where('p.is_active', true)
                ->where('cp.is_active', true)
                ->first();
            if ($controlPoint) {
                // dd($controlPoint);
                $reference = $missionReference . '-' . $controlPoint->family_id . '-' . $controlPoint->domain_id . '-' . $controlPoint->process_id . '-' . $controlPoint->id;
                return ['control_point_id' => $controlPoint->id, 'assigned_to_ci_id' => $assigned_to, 'reference' => $reference];
            }
        })->toArray();

        $campaignProcesses = array_values(array_filter($campaignProcesses, fn ($cp) => !is_null($cp)));
        return $campaignProcesses;
    }

    /**
     * Generate mission report
     *
     * @param Mission $mission
     *
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     */
    private function generateReport(Mission $mission, $notify = true, string $type)
    {
        $user = auth()->user();
        return GenerateMissionReportPdf::dispatch($mission, $user, $notify, $type);
    }

    /**
     * Prepare database attribute and ACLs for validation
     *
     * @param App\Models\Mission $mission
     * @param string $type
     * @return Collection
     **/
    private function validationAttributes(Mission $mission, string $type)
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
            case 'der':
                $validationAtColumn = 'der_validation_at';
                $validationByColumn = 'der_validation_by_id';
                $persistedValidationColumn = 'der_validator_full_name';
                $isAbleOrAbort = hasRole('der');
                $missionState = MissionState::CLASSIFY;
                $notify = [];
                break;
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
}
