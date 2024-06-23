<?php

use App\Models\ControlPoint;
use App\Models\Mission;
use App\Models\Process;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Collection;
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
            DB::raw("CONCAT(cder.first_name, ' ', cder.last_name) AS der_controller_full_name"),
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
            // DB::raw(
            //     '(CASE
            //         WHEN ci_validation_at > programmed_end THEN 1
            //         ELSE 0
            //     END) as is_late_ci'
            // ),

            // DB::raw(
            //     '(CASE
            //         WHEN COALESCE(ci_validation_at, CURRENT_DATE()) > programmed_end OR COALESCE(cdc_validation_at, CURRENT_DATE()) > programmed_end THEN 1
            //         ELSE 0
            //     END) as is_late_cdc'
            // ),
            // DB::raw(
            //     '(CASE
            //         WHEN COALESCE(ci_validation_at, CURRENT_DATE()) > programmed_end OR COALESCE(cdc_validation_at, CURRENT_DATE()) > programmed_end THEN 1
            //         ELSE 0
            //     END) as is_late'
            // ),

            DB::raw('DATEDIFF(day, CAST(programmed_start AS DATE), COALESCE(CAST(ci_validation_at AS DATE), GETDATE())) as ci_time_left'),

            DB::raw('DATEDIFF(day, COALESCE(CAST(ci_validation_at AS DATE), GETDATE()), COALESCE(CAST(cdc_validation_at AS DATE), GETDATE())) as cdc_time_left'),

            DB::raw('DATEDIFF(day, COALESCE(CAST(dcp_validation_at AS DATE), GETDATE()), COALESCE(CAST(da_validation_at AS DATE), GETDATE())) as da_time_left'),
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
            ->leftJoin('users as cder', 'cder.id', 'm.assigned_to_cder_id')
            ->where('m.level', $level);
        if (hasRole('ci')) {
            $missions = $missions->addSelect([
                DB::raw(
                    '(CASE
                        WHEN CAST(ISNULL(ci_validation_at, GETDATE()) AS DATE) > CAST(programmed_end AS DATE) THEN 1
                        ELSE 0
                    END) as is_late'
                ),
            ]);
        } else {
            $missions = $missions->addSelect([
                DB::raw(
                    '(CASE
                        WHEN CAST(ISNULL(ci_validation_at, GETDATE()) AS DATE) > CAST(programmed_end AS DATE) OR CAST(ISNULL(cdc_validation_at, GETDATE()) AS DATE) > CAST(programmed_end AS DATE) THEN 1
                        ELSE 0
                    END) as is_late'
                ),
            ]);
        }
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
                    $query->whereIn('m.agency_id', $user->agencies->pluck('id'))->whereDate('programmed_start', '<=', today()->format('Y-m-d'));
                });
            } elseif (hasRole('dre')) {
                $missions = $missions->whereIn('m.agency_id', $user->agencies->pluck('id'));
            } elseif (hasRole('cder')) {
                $missions = $missions->where('m.assigned_to_cder_id', $user->id);
            } elseif (hasRole('ir')) {
                $missions = $missions->whereIn('agency_id', $user->agencies->pluck('id'));
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
            'cder.first_name',
            'cder.last_name',
            'm.ci_validation_at',
            'm.cdc_validation_at',
            'm.cdcr_validation_at',
            'm.dcp_validation_at',
            'm.da_validation_at',
        );
        // dd($missions->toSql());
        if ($missionId) {
            return $missions->where('m.id', $missionId)->first();
        }
        return $missions;
    }
}

if (!function_exists('translateMissionState')) {

    /**
     * @param int $state
     *
     * @return string
     */
    function translateMissionState(int $state): string
    {
        $stateStr = 'Inconnu';
        if (hasRole(['cdrcp', 'dcp', 'cdcr', 'cc', 'admin', 'root'])) {
            switch ($state) {
                case 1:
                    $stateStr = 'À réaliser';
                    break;
                case 2:
                    $stateStr = 'En cours';
                    break;
                case 3:
                    $stateStr = 'En attente de validation CDC';
                    break;
                case 4:
                    $stateStr = 'En attente de validation CC';
                    break;
                case 5:
                    $stateStr = 'En attente de validation CDCR';
                    break;
                case 6:
                    $stateStr = 'En attente de validation DCP';
                    break;
                case 7:
                    $stateStr = 'Réalisée et validée';
                    break;
                default:
                    $stateStr = 'À réaliser';
                    break;
            }
        } else {
            switch ($state) {
                case 1:
                    $stateStr = 'À réaliser';
                    break;
                case 2:
                    $stateStr = 'En cours';
                    break;
                case 3:
                    $stateStr = 'En attente de validation CDC';
                    break;
                case 4:
                    $stateStr = 'En cours de traitement DCP';
                    break;
                case 5:
                    $stateStr = 'En cours de traitement DCP';
                    break;
                case 6:
                    $stateStr = 'En cours de traitement DCP';
                    break;
                case 7:
                    $stateStr = 'Réalisée et validée';
                    break;
                default:
                    $stateStr = 'À réaliser';
                    break;
            }
        }
        return $stateStr;
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
            ->join('missions as m', 'm.id', 'md.mission_id')
            ->join('control_campaigns as cc', 'cc.id', 'm.control_campaign_id')
            ->join('agencies as a', 'a.id', 'm.agency_id')
            ->join('dres as d', 'd.id', 'a.dre_id')
            ->join('control_points as cp', 'cp.id', 'md.control_point_id')
            ->join('processes as p', 'p.id', 'cp.process_id')
            ->join('domains as dm', 'dm.id', 'p.domain_id')
            ->join('families as f', 'f.id', 'dm.family_id')
            ->leftJoin('users as ci', 'ci.id', 'md.controlled_by_ci_id')
            ->leftJoin('users as ccr', 'ccr.id', 'md.controlled_by_cc_id');

        $user = auth()->user();
        $details = $details->whereNotNull('md.score')->where('md.is_disabled', false);
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
        } elseif (hasRole(['da', 'ir'])) {
            $details = $details->whereIn('m.agency_id', $user->agencies->pluck('id')->toArray())->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole('dre')) {
            $details = $details->whereIn('m.agency_id', $user->agencies->pluck('id'))->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole('cdcr')) {
            $details = $details->whereNotNull('m.cdc_validation_by_id');
        } elseif (hasRole('cc')) {
            $details = $details->whereNotNull('m.assigned_to_cc_id', $user->id)->whereNotNull('m.cdc_validation_by_id');
        } elseif (hasRole('dcp')) {
            $details = $details->whereNotNull('m.cdcr_validation_by_id');
        } elseif (hasRole('dcp')) {
            $details = $details->whereNotNull('m.assigned_to_cder_id');
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
            DB::raw('COUNT(mdr.id) AS total_regularizations')
        ];

        $details = DB::table('mission_details as md')
            ->select($columns)
            ->leftJoin('mission_detail_regularizations AS mdr', 'mdr.mission_detail_id', 'md.id')
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
        } elseif (hasRole('cder')) {
            $details = $details->whereNotNull('m.cdcr_validation_by_id')->where('m.assigned_to_cder_id', $user->id);
        } elseif (hasRole('ir')) {
            $details = $details->whereNotNull('m.dcp_validation_by_id')->whereIn('m.agency_id', $user->agencies->pluck('id')->toArray());
        } else {
            $details = $details->whereNotNull('m.dcp_validation_by_id');
        }

        $details = $details->orderBy('f.display_priority', 'ASC')->orderBy('f.updated_at', 'DESC')
            ->orderBy('dm.display_priority', 'ASC')->orderBy('dm.updated_at', 'DESC')
            ->orderBy('p.display_priority', 'ASC')->orderBy('p.updated_at', 'DESC')
            ->orderBy('cp.display_priority', 'ASC')->orderBy('cp.updated_at', 'DESC');

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
            'cp.display_priority',
            'cp.updated_at',
            'p.display_priority',
            'p.updated_at',
            'dm.display_priority',
            'dm.updated_at',
            'f.display_priority',
            'f.updated_at'
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

        if (hasRole('ci')) {
            $details = $details->join('mission_has_controllers as mhc', 'mhc.mission_id', 'md.mission_id')->whereIn('agency_id', $user->agencies_arr)->where(function ($query) {
                $query->where('major_fact', true)->OrWhereNotNull('md.major_fact_is_detected_at');
            })
                ->where(fn ($query) => $query->where('m.assigned_to_ci_id', $user->id)->orWhere('mhc.user_id', $user->id)->orWhere('controlled_by_ci_id', $user->id));
        } elseif (hasRole('cdc')) {
            $details = $details->whereIn('agency_id', $user->agencies_arr)->where(function ($query) {
                $query->where('major_fact', true)->OrWhereNotNull('md.major_fact_is_detected_at');
            });
        } elseif (hasRole('dre')) {
            $details = $details->whereIn('agency_id', $user->agencies_arr)
                ->whereNotNull('md.major_fact_is_dispatched_at');
        } elseif (hasRole('da')) {
            $details = $details->whereIn('agency_id', $user->agencies_arr)->whereNotNull('md.major_fact_is_dispatched_at')->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole(['dcp', 'cdcr'])) {
            $details = $details->where(function ($query) {
                $query->whereNotNull('md.major_fact_is_dispatched_to_dcp_at')
                    ->WhereNotNull('md.major_fact_is_detected_at');
            });
        } elseif (hasRole(['root', 'admin'])) {
            $details = $details->whereNotNull('md.major_fact_is_detected_at');
        } elseif (hasRole('cder')) {
            $details = $details->whereNotNull('md.major_fact_is_dispatched_at')->where('m.assigned_to_cder_id', $user->id);
        } elseif (hasRole('ir')) {
            $details = $details->whereNotNull('md.major_fact_is_dispatched_at')->whereIn('m.agency_id', $user->agencies->pluck('id')->toArray());
        } else {
            $details = $details->whereNotNull('md.major_fact_is_dispatched_at');
        }

        if ($mission) {
            $details = $details->where('m.id', $mission);
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
     * @param int $type 1|2
     * @param string|null $campaignId
     *
     * @return Builder
     */
    function getControlCampaigns(?string $campaignId = null)
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

        $user = auth()->user();

        if (!hasRole(['dcp', 'cdcr', 'root', 'admin'])) {
            $campaigns = $campaigns->whereNotNull('validated_at');
        }

        if (hasRole('cdcr')) {
            $campaigns = $campaigns->where(function ($query) use ($user) {
                $query->where('c.created_by_id', $user->id)->orWhereNotNull('validated_at');
            });
        }

        if (hasRole('ci')) {
            $campaigns = $campaigns->leftJoin('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id')
                ->where(fn ($query) => $query->where('m.assigned_to_ci_id', $user->id)->orWhere('mhc.user_id', $user->id));
        }

        if (hasRole('cder')) {
            $campaigns = $campaigns->where('m.assigned_to_cder_id', $user->id);
        }

        if (!hasRole(['dre', 'cdc', 'ci', 'da'])) {
            $agencies = getAgencies()->get()->count();
            $campaigns = $campaigns->addSelect([
                'realisation_rate' => DB::raw('(SELECT COUNT(m.id) * 100.0 / ' . $agencies . ' AS realisation_rate FROM missions as m WHERE m.cdc_validation_at IS NOT NULL AND m.control_campaign_id = c.id) AS realisation_rate')
            ]);
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

        $processes = getProcesses()->leftJoin('control_campaign_processes AS ccp', 'ccp.process_id', 'p.id')->where('ccp.control_campaign_id', $campaign);

        return $processes;
    }
}

if (!function_exists('getDre')) {
    function getDre(?User $user = null)
    {
        $user = $user ?: auth()->user();
        $dre = DB::table('dres as d')->select('d.id', 'd.code', 'd.name', DB::raw("CONCAT(d.code,' - ', d.name) as full_name"));

        if (hasRole(['ci', 'cdc', 'dre', 'da', 'ir'])) {
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

        if (hasRole(['ci', 'cdc', 'dre', 'da', 'ir'])) {
            $agencies = $agencies->leftJoin('user_has_agencies as uha', 'uha.agency_id', 'a.id')->where('uha.user_id', $user->id);
        }
        $agencies = $agencies->groupBy('a.id', 'a.code', 'a.name', 'a.dre_id');
        return $agencies;
    }
}

if (!function_exists('getFamilies')) {
    function getFamilies(?int $id = null)
    {
        $families = DB::table('families as f')->select([
            'f.id',
            'f.name',
            'f.code',
            'f.is_active',
            'f.usable_for_agency',
            'f.usable_for_dre',
            'f.display_priority',
            'f.creator_full_name',
            'f.created_at',
            'f.updater_full_name',
            'f.updated_at',
            DB::raw('COUNT(DISTINCT d.id) AS domains_count'),
            DB::raw('COUNT(DISTINCT p.id) AS processes_count'),
            DB::raw('COUNT(DISTINCT cp.id) AS control_points_count'),
            DB::raw('COUNT(DISTINCT m.id) AS missions_count'),
            DB::raw('COUNT(DISTINCT cc.id) AS control_campaigns_count'),
            DB::raw('SUM(CASE WHEN md.score IN (2,3,4) THEN 1 ELSE 0 END) AS anomalies_count'),
            DB::raw('SUM(CASE WHEN md.reg_is_regularized = 1 THEN 1 ELSE 0 END) AS regularizations_count'),
            DB::raw('(SUM(CASE WHEN md.reg_is_regularized = 1 THEN 1 ELSE 0 END) * 100 /
            CASE WHEN SUM(CASE WHEN md.score IN (2,3,4) THEN 1 ELSE 0 END) = 0
                 THEN NULL
                 ELSE SUM(CASE WHEN md.score IN (2,3,4) THEN 1 ELSE 0 END)
            END) as regularizations_rate'),
            DB::raw('(CASE WHEN COUNT(DISTINCT cc.id) > 0 THEN 0 ELSE 1 END) AS is_deletable'),
        ])
            ->leftJoin('domains AS d', 'f.id', 'd.family_id')
            ->leftJoin('processes AS p', 'd.id', 'p.domain_id')
            ->leftJoin('control_points AS cp', 'p.id', 'cp.process_id')
            ->leftJoin('mission_details AS md', 'cp.id', 'md.control_point_id')
            ->leftJoin('missions AS m', 'm.id', 'md.mission_id')
            ->leftJoin('control_campaigns AS cc', 'cc.id', 'm.control_campaign_id')
            ->groupBy(
                'f.id',
                'f.name',
                'f.code',
                'f.is_active',
                'f.usable_for_agency',
                'f.usable_for_dre',
                'f.display_priority',
                'f.updated_at',
                'f.creator_full_name',
                'f.created_at',
                'f.updater_full_name',
                'f.updated_at',
            )
            ->orderBy('f.display_priority', 'ASC')->orderBy('f.updated_at', 'DESC');
        if ($id) {
            $family = $families->where('f.id', $id)->first();
            if (!$family) abort(404, 'La famille rechercher est introuvable');
            $family->is_deletable = boolval($family->is_deletable);
            $family->usable_for_agency = boolval($family->usable_for_agency);
            $family->usable_for_dre = boolval($family->usable_for_dre);
            $family->is_active = boolval($family->is_active);
            $family->created_at = $family->created_at ? Carbon::parse($family->created_at)->format('d-m-Y H:i') : '-';
            $family->updated_at = $family->updated_at ? Carbon::parse($family->updated_at)->format('d-m-Y H:i') : '-';
            return $family;
        }
        return $families;
    }
}

if (!function_exists('getDomains')) {
    function getDomains(?int $id = null)
    {
        $domains = DB::table('domains as d')->select([
            'd.id',
            'd.name',
            'd.is_active',
            'd.usable_for_agency',
            'd.usable_for_dre',
            'd.display_priority',
            'd.creator_full_name',
            'd.created_at',
            'd.updater_full_name',
            'd.updated_at',
            'f.name AS family_name',
            'f.is_active AS family_is_active',
            'f.id AS family_id',
            DB::raw('COUNT(DISTINCT p.id) AS processes_count'),
            DB::raw('COUNT(DISTINCT cp.id) AS control_points_count'),
            DB::raw('COUNT(DISTINCT m.id) AS missions_count'),
            DB::raw('COUNT(DISTINCT cc.id) AS control_campaigns_count'),
            DB::raw('SUM(CASE WHEN md.score IN (2,3,4) THEN 1 ELSE 0 END) AS anomalies_count'),
            DB::raw('(CASE WHEN COUNT(DISTINCT cc.id) > 0 THEN 0 ELSE 1 END) AS is_deletable'),
        ])
            ->leftJoin('families AS f', 'f.id', 'd.family_id')
            ->leftJoin('processes AS p', 'd.id', 'p.domain_id')
            ->leftJoin('control_points AS cp', 'p.id', 'cp.process_id')
            ->leftJoin('mission_details AS md', 'cp.id', 'md.control_point_id')
            ->leftJoin('missions AS m', 'm.id', 'md.mission_id')
            ->leftJoin('control_campaigns AS cc', 'cc.id', 'm.control_campaign_id')
            ->groupBy(
                'd.id',
                'd.name',
                'd.is_active',
                'd.usable_for_agency',
                'd.usable_for_dre',
                'd.display_priority',
                'd.updated_at',
                'd.creator_full_name',
                'd.updater_full_name',
                'd.created_at',
                'f.is_active',
                'f.display_priority',
                'f.updated_at',
                'f.name',
                'f.id'
            )
            ->orderBy('f.display_priority', 'ASC')
            ->orderBy('f.updated_at', 'DESC')
            ->orderBy('d.display_priority', 'ASC')
            ->orderBy('d.updated_at', 'DESC');

        if ($id) {
            $domain = $domains->where('d.id', $id)->first();
            if (!$domain) abort(404, 'Le domaine rechercher est introuvable');
            $domain->is_deletable = boolval($domain->is_deletable);
            $domain->usable_for_agency = boolval($domain->usable_for_agency);
            $domain->usable_for_dre = boolval($domain->usable_for_dre);
            $domain->is_active = boolval($domain->is_active);
            $domain->created_at = $domain->created_at ? Carbon::parse($domain->created_at)->format('d-m-Y H:i') : '-';
            $domain->updated_at = $domain->updated_at ? Carbon::parse($domain->updated_at)->format('d-m-Y H:i') : '-';
            return $domain;
        }

        return $domains;
    }
}

if (!function_exists('getProcesses')) {
    function getProcesses(?int $id = null)
    {
        $processes = DB::table('processes as p')
            ->select([
                'p.id',
                'p.name',
                'p.is_active',
                'p.usable_for_agency',
                'p.usable_for_dre',
                'p.display_priority',
                'p.creator_full_name',
                'p.created_at',
                'p.updater_full_name',
                'p.updated_at',
                'f.name AS family_name',
                'f.id AS family_id',
                'd.name AS domain_name',
                'd.id AS domain_id',
                'd.is_active AS domain_is_active',
                DB::raw('(SELECT COUNT(*) FROM control_points WHERE process_id = p.id AND is_active = 1) AS activated_control_points_count'),
                DB::raw('COUNT(DISTINCT cp.id) AS control_points_count'),
                DB::raw('COUNT(DISTINCT m.id) AS missions_count'),
                DB::raw('COUNT(DISTINCT cc.id) AS control_campaigns_count'),
                DB::raw('SUM(CASE WHEN md.score IN (2,3,4) THEN 1 ELSE 0 END) AS anomalies_count'),
                DB::raw('(CASE WHEN COUNT(DISTINCT cc.id) > 0 THEN 0 ELSE 1 END) AS is_deletable')

            ])
            ->leftJoin('domains AS d', 'd.id', 'p.domain_id')
            ->leftJoin('families AS f', 'f.id', 'd.family_id')
            ->leftJoin('control_points AS cp', 'p.id', 'cp.process_id')
            ->leftJoin('mission_details AS md', 'cp.id', 'md.control_point_id')
            ->leftJoin('missions AS m', 'm.id', 'md.mission_id')
            ->leftJoin('control_campaigns AS cc', 'cc.id', 'm.control_campaign_id')
            ->groupBy(
                'p.id',
                'p.name',
                'p.is_active',
                'p.usable_for_agency',
                'p.usable_for_dre',
                'p.display_priority',
                'p.updated_at',
                'p.created_at',
                'p.creator_full_name',
                'p.updater_full_name',
                'd.display_priority',
                'd.updated_at',
                'd.is_active',
                'f.display_priority',
                'f.updated_at',
                'f.name',
                'f.id',
                'd.name',
                'd.id'
            )
            ->orderBy('f.display_priority', 'ASC')->orderBy('f.updated_at', 'DESC')
            ->orderBy('d.display_priority', 'ASC')->orderBy('d.updated_at', 'DESC')
            ->orderBy('p.display_priority', 'ASC')->orderBy('p.updated_at', 'DESC');

        if ($id) {
            $process = $processes->where('p.id', $id)->first();
            if (!$process) abort(404, 'Le processus rechercher est introuvable');
            $process->is_deletable = boolval($process->is_deletable);
            $process->usable_for_agency = boolval($process->usable_for_agency);
            $process->usable_for_dre = boolval($process->usable_for_dre);
            $process->is_active = boolval($process->is_active);
            $process->created_at = $process->created_at ? Carbon::parse($process->created_at)->format('d-m-Y H:i') : '-';
            $process->updated_at = $process->updated_at ? Carbon::parse($process->updated_at)->format('d-m-Y H:i') : '-';
            return $process;
        }

        return $processes;
    }
}

if (!function_exists('getControlPoints')) {
    function getControlPoints(?int $id = null)
    {
        $control_points = DB::table('control_points as cp')
            ->select([
                'cp.id',
                'cp.name',
                'cp.is_active',
                'cp.usable_for_agency',
                'cp.usable_for_dre',
                'cp.display_priority',
                'cp.has_major_fact',
                'cp.creator_full_name',
                'cp.created_at',
                'cp.updater_full_name',
                'cp.updated_at',
                'f.name AS family_name',
                'f.id AS family_id',
                'd.name AS domain_name',
                'd.id AS domain_id',
                'p.name AS process_name',
                'p.id AS process_id',
                'p.is_active AS process_is_active',
                DB::raw('COUNT(DISTINCT hf.field_id) AS field_count'),
                DB::raw('COUNT(DISTINCT m.id) AS missions_count'),
                DB::raw('COUNT(DISTINCT cc.id) AS control_campaigns_count'),
                DB::raw('SUM(CASE WHEN md.score IN (2,3,4) THEN 1 ELSE 0 END) AS anomalies_count'),
                DB::raw('(CASE WHEN COUNT(DISTINCT cc.id) > 0 THEN 0 ELSE 1 END) AS is_deletable'),
            ])
            ->leftJoin('has_fields AS hf', function ($join) {
                $join->on('hf.attachable_id', 'cp.id')
                    ->where('hf.attachable_type', ControlPoint::class);
            })
            ->leftJoin('processes AS p', 'p.id', 'cp.process_id')
            ->leftJoin('domains AS d', 'd.id', 'p.domain_id')
            ->leftJoin('families AS f', 'f.id', 'd.family_id')
            ->leftJoin('mission_details AS md', 'cp.id', 'md.control_point_id')
            ->leftJoin('missions AS m', 'm.id', 'md.mission_id')
            ->leftJoin('control_campaigns AS cc', 'cc.id', 'm.control_campaign_id')
            ->groupBy(
                'cp.id',
                'cp.name',
                'cp.is_active',
                'cp.usable_for_agency',
                'cp.usable_for_dre',
                'cp.display_priority',
                'cp.updated_at',
                'cp.creator_full_name',
                'cp.created_at',
                'cp.updater_full_name',
                'cp.updated_at',
                'p.display_priority',
                'p.updated_at',
                'p.is_active',
                'd.display_priority',
                'd.updated_at',
                'f.display_priority',
                'f.updated_at',
                'cp.has_major_fact',
                'f.name',
                'f.id',
                'd.name',
                'd.id',
                'p.name',
                'p.id'
            )
            ->orderBy('f.display_priority', 'ASC')->orderBy('f.updated_at', 'DESC')
            ->orderBy('d.display_priority', 'ASC')->orderBy('d.updated_at', 'DESC')
            ->orderBy('p.display_priority', 'ASC')->orderBy('p.updated_at', 'DESC')
            ->orderBy('cp.display_priority', 'ASC')->orderBy('cp.updated_at', 'DESC');

        if ($id) {
            $controlPoint = $control_points->where('cp.id', $id)->first();
            if (!$controlPoint) abort(404, 'Le point de contrôle rechercher est introuvable');
            $controlPoint->is_deletable = boolval($controlPoint->is_deletable);
            $controlPoint->usable_for_agency = boolval($controlPoint->usable_for_agency);
            $controlPoint->usable_for_dre = boolval($controlPoint->usable_for_dre);
            $controlPoint->is_active = boolval($controlPoint->is_active);
            $controlPoint->created_at = $controlPoint->created_at ? Carbon::parse($controlPoint->created_at)->format('d-m-Y H:i') : '-';
            $controlPoint->updated_at = $controlPoint->updated_at ? Carbon::parse($controlPoint->updated_at)->format('d-m-Y H:i') : '-';
            return $controlPoint;
        }

        return $control_points;
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
            'm.id',
            'm.original_name',
            'm.category',
            'm.hash_name',
            'm.folder',
            'm.extension',
            'm.mimetype',
            DB::raw('CAST(m.size as int) AS size'),
            'm.payload',
            'hm.attachable_type',
            'hm.attachable_id',
            'm.uploaded_by_id',
            'm.created_at',
            'm.payload',
            'u.username',
            'u.first_name',
            'u.last_name'
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

        $media->payload = $media?->payload ? json_decode($media->payload, true) : null;
        $payload = $media->payload;
        $media->number = isset($payload['number']) ? $payload['number'] : null;
        $media->date = isset($payload['date']) ? Carbon::parse($payload['date'])->format('d-m-Y') : null;
        $media->object = isset($payload['object']) ? $payload['object'] : null;
        return $media;
    }
}

if (!function_exists('getMediaByForeign')) {
    function getMediaByForeign(string $attachable_type, string|int $attachable_id, ?string $folder)
    {
        $media = DB::table('media as m')->select([
            'm.id', 'm.original_name', 'm.hash_name', 'm.folder', 'm.extension', 'm.mimetype', DB::raw('CAST(m.size as int) AS size'), 'm.payload', 'hm.attachable_type', 'hm.attachable_id', 'm.uploaded_by_id', 'm.created_at', 'm.payload',
            'u.username', 'u.first_name', 'u.last_name',
            DB::raw("CONCAT(m.folder, '\', m.hash_name) AS path")
        ]);

        $media = $media->leftJoin('has_media as hm', 'hm.media_id', 'm.id')
            ->leftJoin('users as u', 'u.id', 'uploaded_by_id');

        $media = $media->where('attachable_type', $attachable_type)->where('attachable_id', $attachable_id)->where(fn ($query) => $query->where('folder', $folder)->orWhere('category', $folder));

        $media = $media->orderBy('created_at', 'DESC');
        return $media;
    }
}

if (!function_exists('getRegulations')) {
    /**
     * Fetch all regulations
     *
     * @return \Illuminate\Support\Collection
     */
    function getRegulations(): Collection
    {
        $regulations = DB::table('media')->select('id', 'original_name')->whereIn('category', ['Circulaires', 'Lettres-circulaire', 'Notes', 'Guides 1er niveau'])->get();
        return $regulations;
    }
}

if (!function_exists('getUsers')) {
    function getUsers()
    {
        $columns = [
            'u.id',
            'u.username',
            DB::raw("CONCAT(u.first_name, ' ', u.last_name) AS full_name"),
            'u.is_active',
            'u.email',
            'u.phone',
            'u.must_change_password',
            'r.code',
            'r.name AS role',
            'u.created_at',
            'u.registration_number',
            DB::raw("(CASE WHEN u.gender = 1 THEN 'Homme' ELSE 'Femme' END) AS gender_str"),
            DB::raw("
            STUFF((
                SELECT DISTINCT ', ' + d.name
                FROM user_has_agencies AS ua
                LEFT JOIN agencies AS a ON ua.agency_id = a.id
                LEFT JOIN dres AS d ON a.dre_id = d.id
                WHERE ua.user_id = u.id
                FOR XML PATH(''), TYPE).value('.', 'NVARCHAR(MAX)'), 1, 2, '') AS dres_str
            "),
            DB::raw("MAX(l.created_at) AS last_activity")
        ];

        $users = DB::table('users as u')
            ->select($columns)
            ->leftJoin('roles as r', 'u.active_role_id', '=', 'r.id')
            ->leftJoin('logins as l', 'u.id', '=', 'l.user_id')
            ->groupBy('u.id', 'u.username', 'u.first_name', 'u.last_name', 'u.email', 'u.phone', 'u.must_change_password', 'r.code', 'r.name', 'u.is_active', 'u.created_at', 'u.registration_number', 'u.gender');

        if (!hasRole(['root', 'admin'])) {
            // $users = $users->whereIn('r.code', ['ci', 'cdc', 'dre', 'der', 'da', 'cder', 'dcp', 'cdrcp']);
            $users = $users->whereNotIn('r.code', ['root', 'admin']);
        }

        return $users;
    }
}
