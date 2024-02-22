<?php

use App\Models\Mission;
use App\Models\Process;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

if (!function_exists('getMissions')) {
    /**
     * Fetch Missions
     *
     * @return Builder|stdClass
     */
    function getMissions(?string $missionId = null, int $level = 2)
    {
        $columns = [
            'm.id',
            'm.reference',
            'cc.reference as campaign',
            'm.creator_full_name',
            'm.cdc_validator_full_name',
            'm.cdcr_validator_full_name',
            'm.dcp_validator_full_name',
            'm.da_validator_full_name',
            DB::raw("CONCAT(dci.first_name, ' ', dci.last_name) AS dre_controller_full_name"),
            DB::raw("CONCAT(dcc.first_name, ' ', dcc.last_name) AS dcp_controller_full_name"),
            DB::raw("CONCAT(ci.first_name, ' ', ci.last_name) AS ci_validator_full_name"),
            DB::raw("CONCAT(ucc.first_name, ' ', ucc.last_name) AS cc_validator_full_name"),
            DB::raw("CONCAT(d.code, ' - ', d.name) as dre"),
            DB::raw("CONCAT(a.code, ' - ', a.name) as agency"),
            DB::raw('(CASE WHEN dcp_validation_by_id IS NOT NULL THEN 1 ELSE 0 END) as is_validated_by_dcp'),
            DB::raw('(CASE WHEN cdcr_validation_by_id IS NOT NULL THEN 1 ELSE 0 END) as is_validated_by_cdcr'),
            DB::raw('(CASE WHEN cdc_validation_by_id IS NOT NULL THEN 1 ELSE 0 END) as is_validated_by_cdc'),
            DB::raw('(CASE WHEN ci_validation_by_id IS NOT NULL THEN 1 ELSE 0 END) as is_validated_by_ci'),
            DB::raw('(CASE WHEN cc_validation_by_id IS NOT NULL THEN 1 ELSE 0 END) as is_validated_by_cc'),
            DB::raw('CAST(ROUND(AVG(CAST(md.score AS DECIMAL(10, 2))), 2) AS VARCHAR(10)) as avg_score'),
            DB::raw('DATEDIFF(day, programmed_start, CAST(GETDATE() AS DATE)) as remaining_days_before_start'),
            DB::raw('DATEDIFF(day, programmed_end,CAST(GETDATE() AS DATE)) as remaining_days_before_end'),
            DB::raw("(CASE WHEN real_start IS NOT NULL THEN FORMAT(m.real_start, 'dd-MM-yyyy') ELSE FORMAT(m.programmed_start, 'dd-MM-yyyy') END) as start_date"),
            DB::raw("(CASE WHEN real_end IS NOT NULL THEN FORMAT(m.real_end, 'dd-MM-yyyy') ELSE FORMAT(m.programmed_end, 'dd-MM-yyyy') END) as end_date"),
            DB::raw('COUNT(CASE WHEN md.is_disabled = 0 THEN 1 END) as total_md'),
            DB::raw('SUM(CASE WHEN md.score IS NOT NULL AND md.is_disabled = 0 THEN 1 ELSE 0 END) as total_controlled_md'),
            DB::raw(
                'CASE
                    WHEN COUNT(md.id) = 0 THEN NULL
                    ELSE SUM(CASE WHEN md.score IS NOT NULL THEN 1 ELSE 0 END) * 100 / NULLIF(COUNT(md.id), 0)
                END as progress_rate'
            ),
            'm.current_state',
            DB::raw(
                '(CASE
                    WHEN DATEDIFF(day, CAST(programmed_start AS DATE), COALESCE(CAST(ci_validation_at AS DATE), GETDATE())) > (DATEDIFF(wk, CAST(programmed_start AS DATE), COALESCE(CAST(ci_validation_at AS DATE), GETDATE())) * 2) + 15 THEN 1
                    ELSE 0
                END) as is_late_ci'
            ),

            DB::raw(
                '(CASE
                    WHEN DATEDIFF(day, CAST(programmed_start AS DATE), COALESCE(CAST(cdc_validation_at AS DATE), GETDATE())) > (DATEDIFF(wk, CAST(programmed_start AS DATE), COALESCE(CAST(cdc_validation_at AS DATE), GETDATE())) * 2) + 15 THEN 1
                    ELSE 0
                END) as is_late_cdc'
            ),

            DB::raw('DATEDIFF(day, CAST(programmed_start AS DATE), COALESCE(CAST(ci_validation_at AS DATE), GETDATE())) as ci_time_left'),

            DB::raw('DATEDIFF(day, COALESCE(CAST(ci_validation_at AS DATE), GETDATE()), COALESCE(CAST(cdc_validation_at AS DATE), GETDATE())) as cdc_time_left'),

            DB::raw('DATEDIFF(day, COALESCE(CAST(dcp_validation_at AS DATE), GETDATE()), COALESCE(CAST(da_validation_at AS DATE), GETDATE())) as da_time_left'),
            DB::raw(
                '(CASE
                    WHEN DATEDIFF(day, CAST(programmed_start AS DATE), COALESCE(CAST(ci_validation_at AS DATE), GETDATE())) > (DATEDIFF(wk, CAST(programmed_start AS DATE), COALESCE(CAST(ci_validation_at AS DATE), GETDATE())) * 2) + 15 THEN 1
                    WHEN DATEDIFF(day, CAST(programmed_start AS DATE), COALESCE(CAST(cdc_validation_at AS DATE), GETDATE())) > (DATEDIFF(wk, CAST(programmed_start AS DATE), COALESCE(CAST(cdc_validation_at AS DATE), GETDATE())) * 2) + 15  THEN 1
                    ELSE 0
                END) as is_late'
            ),
            DB::raw('DATEDIFF(day, m.ci_validation_at, m.cdc_validation_at) as time_left_ci_cdc'),
            DB::raw('DATEDIFF(day, m.cdc_validation_at, m.cdcr_validation_at) as time_left_cdc_cdcr'),
            DB::raw('DATEDIFF(day, m.cdcr_validation_at, m.dcp_validation_at) as time_left_cdcr_dcp'),
            DB::raw('DATEDIFF(day, m.dcp_validation_at, m.da_validation_at) as time_left_dcp_da'),
        ];

        $missions = DB::table('missions as m')
            ->select($columns)
            ->leftJoin('control_campaigns as cc', 'cc.id', 'm.control_campaign_id')
            ->join('agencies as a', 'a.id', 'm.agency_id')
            ->join('dres as d', 'd.id', 'a.dre_id')
            ->leftJoin('mission_details as md', 'md.mission_id', 'm.id')
            ->leftJoin('users as ci', 'ci.id', 'm.ci_validation_by_id')
            ->leftJoin('users as dci', 'dci.id', 'm.assigned_to_ci_id')
            ->leftJoin('users as dcc', 'dcc.id', 'm.assigned_to_cc_id')
            ->leftJoin('users as ucc', 'ucc.id', 'm.cc_validation_by_id')
            ->where('m.level', $level)
            ->whereNull('m.deleted_at');
        $user = auth()->user();

        if ($level == 2) {
            if (hasRole('ci')) {
                $missions = $missions->leftJoin('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id')->where(fn ($query) => $query->where('m.assigned_to_ci_id', $user->id)->orWhere('mhc.user_id', $user->id));
            } elseif (hasRole('cdc')) {
                $missions = $missions->where('m.created_by_id', $user->id);
            } elseif (hasRole('cc')) {
                $missions = $missions->where(function ($query) use ($user) {
                    $query->where('m.assigned_to_cc_id', $user->id)->orWhere('md.assigned_to_cc_id', $user->id);
                });
            } elseif (hasRole('da')) {
                $missions = $missions->where(function ($query) use ($user) {
                    $query->whereIn('m.agency_id', $user->agencies->pluck('id'))->whereNotNull('m.dcp_validation_by_id');
                });
            } elseif (hasRole('dre')) {
                $missions = $missions->whereIn('m.agency_id', $user->agencies->pluck('id'));
            }
        }
        $missions = $missions->groupBy(
            'm.id',
            'm.reference',
            'd.code',
            'd.name',
            'a.code',
            'a.name',
            'dcp_validation_by_id',
            'cdcr_validation_by_id',
            'cdc_validation_by_id',
            'ci_validation_by_id',
            'cc_validation_by_id',
            'm.created_at',
            'cc.reference',
            'm.programmed_start',
            'm.real_start',
            'm.real_end',
            'm.programmed_end',
            'm.current_state',
            'm.creator_full_name',
            'm.cdc_validator_full_name',
            'm.cdcr_validator_full_name',
            'm.dcp_validator_full_name',
            'm.da_validator_full_name',
            'dci.first_name',
            'dci.last_name',
            'dcc.first_name',
            'dcc.last_name',
            'ci.first_name',
            'ci.last_name',
            'ucc.last_name',
            'ucc.first_name',
            'm.ci_validation_at',
            'm.cdc_validation_at',
            'm.cdcr_validation_at',
            'm.dcp_validation_at',
            'm.da_validation_at',
        );
        if ($missionId) {
            return $missions->where('m.id', $missionId)->first();
        }
        return $missions;
    }
}

if (!function_exists('translateMissionState')) {
    function translateMissionState(int $state)
    {
        if (hasRole(['cdrcp', 'dcp', 'cdcr', 'cc'])) {
            $state = 'Inconnu';
            switch ($state) {
                case 1:
                    $state = 'À réaliser';
                    break;
                case 2:
                    $state = 'En cours';
                    break;
                case 3:
                    $state = 'En attente de validation CDC';
                    break;
                case 4:
                    $state = 'En attente de validation CC';
                    break;
                case 5:
                    $state = 'En attente de validation CDCR';
                    break;
                case 6:
                    $state = 'En attente de validation DCP';
                    break;
                case 7:
                    $state = 'En attente de validation DA';
                    break;
                case 8:
                    $state = 'Réalisée, validée et régularisée';
                    break;
                default:
                    $state = 'À réaliser';
                    break;
            }
            return $state;
        } else {
            $state = 'Inconnu';
            switch ($state) {
                case 1:
                    $state = 'À réaliser';
                    break;
                case 2:
                    $state = 'En cours';
                    break;
                case 3:
                    $state = 'En attente de validation CDC';
                    break;
                case 4:
                    $state = 'En cours de traitement DCP';
                    break;
                case 5:
                    $state = 'En cours de traitement DCP';
                    break;
                case 6:
                    $state = 'En cours de traitement DCP';
                    break;
                case 7:
                    $state = 'En attente de validation DA';
                    break;
                case 8:
                    $state = 'Réalisée, validée et régularisée';
                    break;
                default:
                    $state = 'À réaliser';
                    break;
            }
            return $state;
        }
    }
}

if (!function_exists('getMissionDetails')) {
    /**
     * Fetch Mission Details
     *
     * @return Builder
     */
    function getMissionDetails(?string $mission = null)
    {
        $columns = [
            'md.id',
            'm.reference as mission',
            'cc.reference as campaign',
            DB::raw("CONCAT(d.code, ' - ', d.name) as dre"),
            DB::raw("CONCAT(a.code, ' - ', a.name) as agency"),
            'd.id as dre_id',
            'a.id as agency_id',
            'f.id as family_id',
            'f.name as family',
            'dm.id as domain_id',
            'dm.name as domain',
            'p.id as process_id',
            'p.name as process',
            'cp.id as control_point_id',
            'cp.name as control_point',
            'md.score',
            'md.recovery_plan',
            DB::raw("(CASE WHEN md.controlled_by_ci_at IS NOT NULL THEN 1 ELSE 0 END) as is_controlled_by_ci"),
            DB::raw("(CASE WHEN md.controlled_by_cdc_at IS NOT NULL THEN 1 ELSE 0 END) as is_controlled_by_cdc"),
            DB::raw("(CASE WHEN md.controlled_by_cc_at IS NOT NULL THEN 1 ELSE 0 END) as is_controlled_by_cc"),
            DB::raw("(CASE WHEN md.controlled_by_cdcr_at IS NOT NULL THEN 1 ELSE 0 END) as is_controlled_by_cdcr"),
            DB::raw("(CASE WHEN md.controlled_by_dcp_at IS NOT NULL THEN 1 ELSE 0 END) as is_controlled_by_dcp"),
            DB::raw('CONVERT(NVARCHAR(10), major_fact_is_dispatched_at, 105) as major_fact_is_dispatched_at'),
            DB::raw('(CASE WHEN major_fact_is_dispatched_at IS NOT NULL THEN 1 ELSE 0 END) as major_fact_is_dispatched_by_dcp'),
            DB::raw('(CASE WHEN major_fact_is_dispatched_to_dcp_at IS NOT NULL THEN 1 ELSE 0 END) as major_fact_is_dispatched_to_dcp'),
            DB::raw('(CASE WHEN major_fact_is_rejected_at_dcp IS NOT NULL THEN 1 ELSE 0 END) as major_fact_is_pending_at_dcp'),
            DB::raw('(CASE WHEN major_fact_is_rejected_at_dre IS NOT NULL THEN 1 ELSE 0 END) as major_fact_is_pending_at_dre'),
            'md.cdc_full_name',
            'md.cdcr_full_name',
            'md.dcp_full_name',
            DB::raw("CONCAT(ci.first_name, ' ', ci.last_name) as ci_full_name"),
            DB::raw("CONCAT(ccr.first_name, ' ', ccr.last_name) as cc_full_name"),
            'md.major_fact_is_dispatched_by_full_name',
            'md.major_fact_is_dispatched_to_dcp_by_full_name',
            'md.major_fact_is_detected_by_full_name',
            'md.major_fact_is_detected_at',
            'md.major_fact_is_rejected_at_dcp',
            'md.major_fact_is_rejected_at_dre',
            'md.major_fact',
            'md.controlled_by_ci_at',
            'md.controlled_by_cdc_at',
            'md.controlled_by_cc_at',
            'md.controlled_by_cdcr_at',
            'md.controlled_by_dcp_at',
            'md.metadata',
            'md.reg_is_regularized',
            'md.reg_is_rejected',
            'md.reg_is_sanitation_in_progress',
        ];

        $details = DB::table('mission_details as md')
            ->select($columns)
            ->whereNotNull('md.score')
            ->join('missions as m', 'm.id', 'md.mission_id')
            ->join('control_campaigns as cc', 'cc.id', 'm.control_campaign_id')
            ->join('agencies as a', 'a.id', 'm.agency_id')
            ->join('dres as d', 'd.id', 'a.dre_id')
            ->join('control_points as cp', 'cp.id', 'md.control_point_id')
            ->join('processes as p', 'p.id', 'cp.process_id')
            ->join('domains as dm', 'dm.id', 'p.domain_id')
            ->join('families as f', 'f.id', 'dm.family_id')
            ->leftJoin('users as ci', 'ci.id', 'md.controlled_by_ci_id')
            ->leftJoin('users as ccr', 'ccr.id', 'md.controlled_by_cc_id')
            ->whereNull('md.deleted_at');

        $user = auth()->user();
        if (hasRole('ci')) {
            $details = $details->leftJoin('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id')
                ->where(
                    fn ($query) => $query
                        ->where('m.assigned_to_ci_id', $user->id)
                        ->orWhere('mhc.user_id', $user->id)
                        ->orWhere('md.assigned_to_ci_id', $user->id)
                        ->orWhere('md.controlled_by_ci_id', $user->id)
                        ->orWhere('md.assigned_to_ci_id', $user->id)
                );
        } elseif (hasRole('cdc')) {
            $details = $details->where('m.created_by_id', $user->id)->where('dre_id', getDre(auth()->user())->first()->id);
        } elseif (hasRole('cc')) {
            $details = $details->where(fn ($query) => $query->where('m.assigned_to_cc_id', $user->id)->orWhere('md.assigned_to_cc_id', $user->id)->orWhere('md.controlled_by_ci_id', $user->id));
        } elseif (hasRole('da')) {
            $details = $details->whereIn('m.agency_id', $user->agencies->pluck('id')->toArray())->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole('dre')) {
            $details = $details->whereIn('m.agency_id', $user->agencies->pluck('id'))->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole('cdcr')) {
            $details = $details->whereNotNull('m.cdc_validation_by_id');
        } elseif (hasRole('cc')) {
            $details = $details->whereNotNull('m.assigned_to_cc_id', $user->id)->whereNotNull('m.cdc_validation_by_id');
        } elseif (hasRole('dcp')) {
            $details = $details->whereNotNull('m.cdcr_validation_by_id');
        } else {
            $details = $details->whereNotNull('m.dcp_validation_by_id');
        }

        if ($mission) {
            $details = $details->where('md.mission_id', $mission);
        }

        $details = $details->groupBy(
            'm.id',
            'md.id',
            'm.reference',
            'cc.reference',
            'd.code',
            'd.name',
            'a.code',
            'a.name',
            'f.name',
            'dm.name',
            'p.name',
            'cp.name',
            'f.id',
            'dm.id',
            'p.id',
            'cp.id',
            'md.score',
            'md.created_at',
            'md.id',
            'd.id',
            'a.id',
            'md.controlled_by_ci_at',
            'md.controlled_by_cdc_at',
            'md.controlled_by_cc_at',
            'md.controlled_by_cdcr_at',
            'md.controlled_by_dcp_at',
            'major_fact_is_dispatched_at',
            'md.recovery_plan',
            'md.major_fact_is_dispatched_at',
            'md.major_fact_is_dispatched_to_dcp_at',
            'md.major_fact_is_rejected_at_dcp',
            'md.major_fact_is_rejected_at_dre',
            'md.major_fact_is_detected_at',
            'md.major_fact_is_dispatched_by_full_name',
            'md.major_fact_is_dispatched_to_dcp_by_full_name',
            'md.major_fact_is_detected_by_full_name',
            'md.major_fact',
            'md.cdc_full_name',
            'md.cdcr_full_name',
            'md.dcp_full_name',
            'ci.first_name',
            'ci.last_name',
            'ccr.first_name',
            'ccr.last_name',
            'md.metadata',
            'md.reg_is_regularized',
            'md.reg_is_rejected',
            'md.reg_is_sanitation_in_progress',
        );
        return $details;
    }
}

if (!function_exists('getMissionAnomalies')) {
    /**
     * Fetch Mission anomalies
     *
     * @param string|null $mission
     *
     * @return Builder
     */
    function getMissionAnomalies(?string $mission = null)
    {
        $columns = [
            'md.id',
            'md.reference',
            'm.reference as mission',
            'cc.reference as campaign',
            DB::raw("CONCAT(d.code, ' - ', d.name) as dre"),
            DB::raw("CONCAT(a.code, ' - ', a.name) as agency"),
            'd.id as dre_id',
            'a.id as agency_id',
            'f.id as family_id',
            'f.name as family',
            'dm.id as domain_id',
            'dm.name as domain',
            'p.id as process_id',
            'p.name as process',
            'cp.id as control_point_id',
            'cp.name as control_point',
            'md.score',
            DB::raw("(CASE WHEN md.controlled_by_ci_at IS NOT NULL THEN 1 ELSE 0 END) as controlled_by_ci_at"),
            DB::raw("(CASE WHEN md.controlled_by_cdc_at IS NOT NULL THEN 1 ELSE 0 END) as controlled_by_cdc_at"),
            DB::raw("(CASE WHEN md.controlled_by_cc_at IS NOT NULL THEN 1 ELSE 0 END) as controlled_by_cc_at"),
            DB::raw("(CASE WHEN md.controlled_by_cdcr_at IS NOT NULL THEN 1 ELSE 0 END) as controlled_by_cdcr_at"),
            DB::raw("(CASE WHEN md.controlled_by_dcp_at IS NOT NULL THEN 1 ELSE 0 END) as controlled_by_dcp_at"),
            'md.reg_is_regularized',
            'md.reg_is_rejected',
            'md.reg_is_sanitation_in_progress',
        ];

        $details = DB::table('mission_details as md')
            ->select($columns)
            ->join('missions as m', 'm.id', 'md.mission_id')
            ->join('control_campaigns as cc', 'cc.id', 'm.control_campaign_id')
            ->join('agencies as a', 'a.id', 'm.agency_id')
            ->join('dres as d', 'd.id', 'a.dre_id')
            ->join('control_points as cp', 'cp.id', 'md.control_point_id')
            ->join('processes as p', 'p.id', 'cp.process_id')
            ->join('domains as dm', 'dm.id', 'p.domain_id')
            ->join('families as f', 'f.id', 'dm.family_id');

        $details = $details->whereIn('score', [2, 3, 4]);

        if (!hasRole('da')) {
            $details = $details->where('major_fact', false);
        }

        if ($mission) {
            $details = $details->where('m.id', $mission);
        }


        $user = auth()->user();
        if (hasRole('ci')) {
            $details = $details->leftJoin('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id')
                ->where(fn ($query) => $query
                    ->where('m.assigned_to_ci_id', $user->id)
                    ->orWhere('mhc.user_id', $user->id)
                    ->orWhere('md.assigned_to_ci_id', $user->id)
                    ->orWhere('md.controlled_by_ci_id', $user->id)
                    ->orWhere('md.assigned_to_ci_id', $user->id));
        } elseif (hasRole('cdc')) {
            $details = $details->where('m.created_by_id', $user->id)->where('dre_id', getDre(auth()->user())->first()->id);
        } elseif (hasRole('cc')) {
            $details = $details->where(fn ($query) => $query->where('m.assigned_to_cc_id', $user->id)->orWhere('md.assigned_to_cc_id', $user->id)->orWhere('md.controlled_by_cc_id', $user->id)->orWhere('md.assigned_to_cc_id', $user->id));
        } elseif (hasRole('da')) {
            $details = $details->whereIn('m.agency_id', $user->agencies->pluck('id')->toArray())->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole('dre')) {
            $details = $details->whereIn('m.agency_id', $user->agencies->pluck('id'))->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole('cdcr')) {
            $details = $details->whereNotNull('m.cdc_validation_by_id');
        } elseif (hasRole('cc')) {
            $details = $details->whereNotNull('m.assigned_to_cc_id', $user->id)->whereNotNull('m.cdc_validation_by_id');
        } elseif (hasRole('dcp')) {
            $details = $details->whereNotNull('m.cdcr_validation_by_id');
        } else {
            $details = $details->whereNotNull('m.dcp_validation_by_id');
        }

        $details = $details->groupBy(
            'md.reference',
            'md.id',
            'm.reference',
            'cc.reference',
            'd.code',
            'd.name',
            'a.code',
            'a.name',
            'f.name',
            'dm.name',
            'p.name',
            'cp.name',
            'f.id',
            'dm.id',
            'p.id',
            'cp.id',
            'md.score',
            'md.created_at',
            'md.id',
            'd.id',
            'a.id',
            'md.controlled_by_ci_at',
            'md.controlled_by_cdc_at',
            'md.controlled_by_cc_at',
            'md.controlled_by_cdcr_at',
            'md.controlled_by_dcp_at',
            'md.reg_is_regularized',
            'md.reg_is_rejected',
            'md.reg_is_sanitation_in_progress',
        );
        return $details;
    }
}


if (!function_exists('getMajorFacts')) {
    /**
     * Fetch Mission major facts
     *
     * @param string|null $mission
     *
     * @return Builder
     */
    function getMajorFacts(?string $mission = null)
    {
        $columns = [
            'md.id',
            'md.reference',
            'm.reference as mission',
            'cc.reference as campaign',
            DB::raw("CONCAT(d.code, ' - ', d.name) as dre"),
            DB::raw("CONCAT(a.code, ' - ', a.name) as agency"),
            'd.id as dre_id',
            'a.id as agency_id',
            'f.id as family_id',
            'f.name as family',
            'dm.id as domain_id',
            'dm.name as domain',
            'p.id as process_id',
            'p.name as process',
            'cp.id as control_point_id',
            'cp.name as control_point',
            DB::raw('CONVERT(NVARCHAR(10), major_fact_is_dispatched_at, 105) as major_fact_is_dispatched_at'),
            DB::raw('(CASE WHEN major_fact_is_dispatched_at IS NOT NULL THEN 1 ELSE 0 END) as major_fact_is_dispatched_by_dcp'),
            DB::raw('(CASE WHEN major_fact_is_dispatched_to_dcp_at IS NOT NULL THEN 1 ELSE 0 END) as major_fact_is_dispatched_to_dcp'),
            'md.major_fact_is_rejected_at_dcp',
            'md.major_fact_is_rejected_at_dre',
            'md.controlled_by_ci_at',
            'md.controlled_by_cdc_at',
            'md.controlled_by_cc_at',
            'md.controlled_by_cdcr_at',
            'md.controlled_by_dcp_at',
            'md.reg_is_regularized',
            'md.reg_is_rejected',
            'md.reg_is_sanitation_in_progress',
        ];

        $details = DB::table('mission_details as md')
            ->select($columns)
            ->whereNotNull('md.score')
            ->join('missions as m', 'm.id', 'md.mission_id')
            ->join('control_campaigns as cc', 'cc.id', 'm.control_campaign_id')
            ->join('agencies as a', 'a.id', 'm.agency_id')
            ->join('dres as d', 'd.id', 'a.dre_id')
            ->join('control_points as cp', 'cp.id', 'md.control_point_id')
            ->join('processes as p', 'p.id', 'cp.process_id')
            ->join('domains as dm', 'dm.id', 'p.domain_id')
            ->join('families as f', 'f.id', 'dm.family_id');

        $user = auth()->user();
        if (hasRole(['ci', 'cdc'])) {
            $details = $details->whereIn('agency_id', $user->agencies_arr)->where(function ($query) {
                $query->where('major_fact', true)->OrWhereNotNull('md.major_fact_is_detected_at');
            });
        } elseif (hasRole(['da', 'dre'])) {
            $details = $details->whereIn('agency_id', $user->agencies_arr)
                ->whereNotNull('md.major_fact_is_dispatched_at');
        } elseif (hasRole(['cdcr', 'dcp'])) {
            $details = $details->where(function ($query) {
                $query->whereNotNull('md.major_fact_is_dispatched_to_dcp_at')
                    ->WhereNotNull('md.major_fact_is_detected_at');
            });
        } elseif (hasRole(['root', 'admin'])) {
            $details = $details->whereNotNull('md.major_fact_is_detected_at');
        } else {
            $details = $details->where('major_fact', true)->orWhereNotNull('md.major_fact_is_dispatched_at');
        }

        if ($mission) {
            $details = $details->where('m.id', $mission);
        }

        $user = auth()->user();

        if (hasRole(['dcp', 'cdcr'])) {
            $details = $details->whereNotNull('md.major_fact_is_dispatched_to_dcp_at');
        } elseif (hasRole('ci')) {
            $details = $details->join('mission_has_controllers as mhc', 'mhc.mission_id', 'md.mission_id')
                ->where(fn ($query) => $query->where('m.assigned_to_ci_id', $user->id)->orWhere('mhc.user_id', $user->id)->orWhere('controlled_by_ci_id', $user->id));
        } elseif (hasRole('cdc')) {
            $details = $details->whereIn('agency_id', $user->agencies->pluck('id'));
        } elseif (hasRole('da')) {
            $details = $details->whereIn('agency_id', $user->agencies->pluck('id')->toArray())->whereNotNull('m.dcp_validation_by_id');
        } else {
            $details->whereNotNull('major_fact_is_dispatched_at');
        }

        $details = $details->groupBy(
            'md.id',
            'md.reference',
            'm.reference',
            'cc.reference',
            'd.code',
            'd.name',
            'a.code',
            'a.name',
            'f.name',
            'dm.name',
            'p.name',
            'cp.name',
            'f.id',
            'dm.id',
            'p.id',
            'cp.id',
            'md.created_at',
            'md.id',
            'd.id',
            'a.id',
            'md.major_fact',
            'md.major_fact_is_dispatched_at',
            'md.major_fact_is_dispatched_to_dcp_at',
            'md.major_fact_is_rejected_at_dcp',
            'md.major_fact_is_rejected_at_dre',
            'md.major_fact_is_detected_at',
            'md.controlled_by_ci_at',
            'md.controlled_by_cdc_at',
            'md.controlled_by_cc_at',
            'md.controlled_by_cdcr_at',
            'md.controlled_by_dcp_at',
            'md.reg_is_regularized',
            'md.reg_is_rejected',
            'md.reg_is_sanitation_in_progress',
        );
        return $details;
    }
}

if (!function_exists('getControlCampaigns')) {
    /**
     * Fetch Control Campaigns
     *
     * @param App\Models\User|null
     *
     * @return Builder
     */
    function getControlCampaigns(?User $user = null, ?string $campaignId = null)
    {
        $columns = [
            'c.reference',
            'c.id',
            'c.created_by_id',
            'c.validated_by_id',
            'c.created_at',
            'c.creator_full_name',
            'c.validator_full_name',
            DB::raw('(CASE WHEN c.is_for_testing = 1 THEN \'Oui\' ELSE \'Non\' END) AS is_for_testing_str'),
            DB::raw('CONVERT(NVARCHAR(10), start_date, 105) as start_date'),
            DB::raw('CONVERT(NVARCHAR(10), end_date, 105) as end_date'),
            DB::raw('DATEDIFF(day, CAST(GETDATE() AS DATE), start_date) as remaining_days_before_start'),
            DB::raw('DATEDIFF(day, CAST(GETDATE() AS DATE), end_date) as remaining_days_before_end'),
            DB::raw('(CASE WHEN c.validated_at IS NOT NULL THEN 1 ELSE 0 END) AS is_validated'),
            'c.is_for_testing',
            DB::raw('COUNT(m.id) as total_missions'),
            DB::raw('SUM(CASE WHEN m.dcp_validation_at IS NOT NULL THEN 1 ELSE 0 END) as total_missions_validated'),
            'c.validated_at'
        ];

        $campaigns = DB::table('control_campaigns as c')->select($columns);

        $campaigns = $campaigns->leftJoin('missions as m', 'm.control_campaign_id', 'c.id');

        $campaigns = $campaigns->whereNull('c.deleted_at');

        $user = $user ?: auth()->user();

        if (hasRole('cdcr')) {
            $campaigns = $campaigns->where(function ($query) use ($user) {
                $query->where('c.created_by_id', $user->id)->orWhereNotNull('validated_at');
            });
        }

        if (!hasRole(['dcp', 'cdcr', 'root', 'admin'])) {
            $campaigns = $campaigns->whereNotNull('validated_at');
        }


        if (!hasRole(['dre', 'cdc', 'ci', 'da'])) {
            $agencies = getAgencies()->get()->count();
            $campaigns = $campaigns->addSelect([
                'realisation_rate' => DB::raw('(SELECT COUNT(m.id) * 100.0 / ' . $agencies . ' AS realisation_rate FROM missions as m WHERE m.cdc_validation_at IS NOT NULL AND m.control_campaign_id = c.id) AS realisation_rate')
            ]);
        }

        if (hasRole('ci')) {
            $campaigns = $campaigns->leftJoin('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id')
                ->where(fn ($query) => $query->where('m.assigned_to_ci_id', $user->id)->orWhere('mhc.user_id', $user->id));
        }

        if (hasRole(['dre', 'cdc', 'ci'])) {
            $agencies = auth()->user()->agencies_arr;
            $campaigns = $campaigns->addSelect([
                'total_missions_dre' => DB::raw('(SELECT COUNT(m.id) AS total_missions_dre FROM missions as m WHERE m.agency_id IN (' . implode(',', $agencies) . ') AND m.control_campaign_id = c.id) AS total_missions_dre'),
                'total_missions_validated_dre' => DB::raw('(SELECT COUNT(m.id) AS total_missions_validated_dre FROM missions as m WHERE m.cdc_validation_at IS NOT NULL AND m.agency_id IN (' . implode(',', $agencies) . ') AND m.control_campaign_id = c.id) AS total_missions_validated_dre'),
                'realisation_rate_dre' => DB::raw('(SELECT COUNT(DISTINCT m.agency_id) * 100.0 / ' . count($agencies) . ' AS realisation_rate_dre FROM missions as m WHERE m.cdc_validation_at IS NOT NULL AND m.control_campaign_id = c.id AND m.agency_id IN (' . implode(',', $agencies) . ')) AS realisation_rate_dre')
            ]);
        }
        $campaigns = $campaigns->groupBy(
            'c.id',
            'c.reference',
            'c.created_by_id',
            'c.validated_by_id',
            'c.start_date',
            'c.end_date',
            'c.validated_at',
            'c.created_at',
            'c.creator_full_name',
            'c.validator_full_name',
            'c.is_for_testing',
        );
        if ($campaignId) {
            return $campaigns->where('c.id', $campaignId)->first();
        }

        return $campaigns;
    }
}

if (!function_exists('getControlCampaignProcesses')) {
    /**
     * Fetch processes list by control campaign
     *
     * @param int|stdClass $campaign
     *
     * @return Builder
     */
    function getControlCampaignProcesses(int|stdClass $campaign)
    {
        $campaign = $campaign instanceof stdClass ? $campaign?->id : $campaign;

        $processes = DB::table('control_campaign_processes', 'ccp')->select([
            'f.id as family_id',
            'd.id as domain_id',
            'p.id',
            'p.name as process',
            'd.name as domain',
            'f.name as family',
            DB::raw('COUNT(cp.id) as control_points_count')
        ])
            ->leftJoin('control_points as cp', 'cp.process_id', 'ccp.process_id')
            ->leftJoin('processes as p', 'p.id', 'ccp.process_id')
            ->leftJoin('domains as d', 'd.id', 'p.domain_id')
            ->leftJoin('families as f', 'f.id', 'd.family_id')
            ->where('control_campaign_id', $campaign)
            ->groupBy('p.id', 'p.name', 'd.name', 'f.name', 'f.id', 'd.id', 'p.id')
            ->orderBy('f.id')
            ->orderBy('d.id')
            ->orderBy('p.id');

        return $processes;
    }
}

if (!function_exists('getDre')) {
    function getDre(?User $user = null)
    {
        $user = $user ?: auth()->user();
        $dre = DB::table('dres as d')->select('d.id', 'd.code', 'd.name', DB::raw("CONCAT(d.code,' - ', d.name) as full_name"));

        if (hasRole(['ci', 'cdc', 'dre', 'da'])) {
            $dre = $dre->leftJoin('agencies as ag', 'd.id', 'ag.dre_id')->leftJoin('user_has_agencies as uha', 'uha.agency_id', 'ag.id')->where('uha.user_id', $user->id);
        }
        $dre = $dre->groupBy('d.id', 'd.code', 'd.name');
        // if ($first) {
        //     return $dre->first();
        // }
        return $dre;
        // return $dre->get();
    }
}

if (!function_exists('getAgencies')) {
    function getAgencies(?User $user = null)
    {
        $user = $user ?: auth()->user();
        $agencies = DB::table('agencies as a')->select('a.id', 'a.code', 'a.name', DB::raw("CONCAT(a.code,' - ', a.name) as full_name"), 'a.dre_id as dre');

        if (hasRole(['ci', 'cdc', 'dre', 'da'])) {
            $agencies = $agencies->leftJoin('user_has_agencies as uha', 'uha.agency_id', 'a.id')->where('uha.user_id', $user->id);
        }
        $agencies = $agencies->groupBy('a.id', 'a.code', 'a.name', 'a.dre_id');
        return $agencies;
    }
}

if (!function_exists('getFamilies')) {
    function getFamilies()
    {
        $families = DB::table('families as f')->select('f.id', 'f.name');
        return $families;
    }
}

if (!function_exists('getDomains')) {
    function getDomains()
    {
        $domains = DB::table('domains as d')->select('d.id', 'd.name');
        return $domains;
    }
}

if (!function_exists('getProcesses')) {
    function getProcesses()
    {
        $processes = DB::table('processes as p')->select('p.id', 'p.name');
        return $processes;
    }
}

if (!function_exists('search')) {
    /**
     * Search in query builder
     *
     * @param Builder $query
     * @param string|null $value
     *
     * @return Illuminate\Contracts\Database\Query\Builder
     */
    function search(Builder $query, ?string $value): Builder
    {
        $columns = $query->columns;
        $query = $query->where(function ($query) use ($columns, $value) {
            $i = 0;
            foreach ($columns as $key => $column) {
                $field = $column;
                $isAlias = false;
                // Check if the column has an alias
                if (str_contains($column, 'as')) {
                    $isAlias = true;
                    [$field, $alias] = explode(' as ', strtolower($column));
                    $field = trim($field);
                }
                if ($field !== 'password' && !str_contains($field, 'id')) {
                    if ($isAlias) {
                        $clause = 'having';
                    } else {
                        $clause = $i > 0 ? 'orWhere' : 'where';
                    }
                    $query = $query->$clause($field, 'LIKE', '%' . $value . '%');
                }
                $i += 1;
            }
            return $query;
        });
        return $query;
    }
}

if (!function_exists('orderByMultiple')) {
    /**
     * Order by multiple columns in query builder
     *
     * @param Builder $query
     * @param string|null $value
     *
     * @return Illuminate\Contracts\Database\Query\Builder
     */
    function orderByMultiple(Builder $query, ?array $data): Builder
    {
        foreach ($data as $column => $direction) {
            $query = $query->orderBy($column, $direction);
        }
        return $query;
    }
}

if (!function_exists('getMedia')) {
    function getMedia(string|array $mediaIds = null)
    {
        $media = DB::table('media', 'm')->select([
            'm.id', 'm.original_name', 'm.hash_name', 'm.folder', 'm.extension', 'm.mimetype', DB::raw('CAST(m.size as int) AS size'), 'm.payload', 'hm.attachable_type', 'hm.attachable_id', 'm.uploaded_by_id', 'm.created_at', 'm.payload',
            'u.username', 'u.first_name', 'u.last_name'
        ]);


        if ($mediaIds) {
            $mediaIds = gettype($mediaIds) == 'string' ? explode(',', $mediaIds) : $mediaIds;
            $media = $media->whereIn('m.id', $mediaIds);
        }

        $media = $media->leftJoin('has_media as hm', 'hm.media_id', 'm.id')
            ->leftJoin('users as u', 'u.id', 'uploaded_by_id')
            ->orderBy('size', 'DESC');

        return $media;
    }
}

if (!function_exists('getSingleMedia')) {
    function getSingleMedia(string $id)
    {
        $media = getMedia($id)->first();
        $media->size_str = formatBytes($media->size);
        $media->type = $media->attachable_type ? getMediaType($media->attachable_type, $media->folder) : null;
        $media->created_at_formatted = Carbon::parse($media->created_at)->diffForHumans();
        $media->full_name = $media->first_name && $media->last_name ? ucfirst(strtolower($media->first_name)) . ' ' . ucfirst(strtolower($media->last_name)) : 'Système';
        $media->path = $media->folder . '/' . $media->hash_name;
        $media->link = getMediaLink($media->folder, $media->hash_name);
        $media->icon = getMediaIcon($media);
        $media->storage_link = getMediaStorageLink($media->folder, $media->hash_name);
        $media->is_owner = true;
        return $media;
    }
}

if (!function_exists('getMediaByForeign')) {
    function getMediaByForeign(string $attachable_type, string|int $attachable_id, ?string $folder)
    {
        $media = DB::table('media as m')->select([
            'm.id', 'm.original_name', 'm.hash_name', 'm.folder', 'm.extension', 'm.mimetype', DB::raw('CAST(m.size as int) AS size'), 'm.payload', 'hm.attachable_type', 'hm.attachable_id', 'm.uploaded_by_id', 'm.created_at', 'm.payload',
            'u.username', 'u.first_name', 'u.last_name'
        ]);

        $media = $media->leftJoin('has_media as hm', 'hm.media_id', 'm.id')
            ->leftJoin('users as u', 'u.id', 'uploaded_by_id');

        $media = $media->where('attachable_type', $attachable_type)->where('attachable_id', $attachable_id)->where('folder', $folder);

        $media = $media->orderBy('created_at', 'DESC');
        return $media;
    }
}

if (!function_exists('getMissionProcesses')) {
    /**
     * Load mission processes
     *
     * @param Mission|string $mission
     * @param Process|int|null $process
     *
     * @return Illuminate\Database\Query\Builder
     */
    function getMissionProcesses(Mission|string $mission, Process|int $process = null)
    {
        $mission = is_string($mission) ? $mission : $mission->id;
        if ($process) {
            $process = is_integer($process) ? $process : $process->id;
        }
        $processes = DB::table('processes as p');
        $processes = $processes->selectRaw("
            p.id as process_id,
            p.name as process,
            d.name as domain,
            f.name as family,
            f.id as family_id,
            d.id as domain_id,
            CASE WHEN COUNT(CASE WHEN md.major_fact > 0 THEN 1 ELSE NULL END) > 0 THEN 'Oui' ELSE 'Non' END AS major_fact,
            COUNT(CASE WHEN score IN (2, 3, 4) THEN 1 ELSE NULL END) AS total_anomalies,
            COUNT(cp.id) as control_points_count,
            AVG(md.score) as avg_score,
            COUNT(md.id) AS total_mission_details,
            SUM(CASE WHEN md.score IS NOT NULL THEN 1 ELSE 0 END) AS scored_mission_details,
            (COUNT(CASE WHEN score IN (2, 3, 4) THEN 1 ELSE NULL END) * 100) / NULLIF(COUNT(md.id), 0) AS anomalies_rate,
            (COUNT(md.score) * 100) / NULLIF(COUNT(md.id), 0) AS progress_status,
            (CASE WHEN (CASE WHEN md.is_disabled = 1 THEN COUNT(md.id) ELSE 0 END) > 0 THEN 1 ELSE 0 END) as is_disabled,
            md.assigned_to_cc_id
        ");
        $processes = $processes->join('control_points as cp', 'p.id', '=', 'cp.process_id')
            ->leftJoin('domains as d', 'd.id', '=', 'p.domain_id')
            ->leftJoin('families as f', 'f.id', '=', 'd.family_id')
            ->leftJoin('mission_details as md', 'cp.id', '=', 'md.control_point_id')
            ->leftJoin('missions as m', 'm.id', '=', 'md.mission_id')
            ->groupBy('f.id', 'd.id', 'p.id', 'p.name', 'd.name', 'f.name', 'md.is_disabled', 'md.assigned_to_cc_id')
            ->where('m.id', $mission);
        if ($process) {
            $processes = $processes->where('p.id', $process);
            return $processes->get()->first();
        }
        return $processes;
    }
}
