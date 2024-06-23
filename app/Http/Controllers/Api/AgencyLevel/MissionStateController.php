<?php

namespace App\Http\Controllers\Api\AgencyLevel;

use App\DB\Queries\ControlCampaignQuery;
use App\Http\Controllers\Controller;
use App\Http\Resources\MissionStateResource;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MissionStateController extends Controller
{
    public function index()
    {
        isAbleOrAbort(['view_mission_detail']);

        // Url params
        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);


        // Query
        $missionsStates = DB::table('mission_details AS md')
            ->leftJoin('missions AS m', 'm.id', 'md.mission_id')
            ->leftJoin('agencies AS a', 'a.id', 'm.agency_id')
            ->leftJoin('dres AS d', 'd.id', 'a.dre_id')
            ->leftJoin('control_campaigns AS cc', 'cc.id', 'm.control_campaign_id')
            ->select([
                'cc.reference AS cc_reference',
                'cc.id AS cc_id',
                'm.reference AS m_reference',
                'm.id AS m_id',
                DB::raw('SUM(CASE WHEN md.score IN (2,3,4) THEN 1 ELSE 0 END) AS total_anomalies'),
                DB::raw('SUM(CASE WHEN md.reg_is_regularized = 1 THEN 1 ELSE 0 END) AS total_regularized'),
                DB::raw(
                    'CASE
                        WHEN SUM(CASE WHEN md.score IN (2,3,4) THEN 1 ELSE 0 END) = 0 THEN NULL
                        ELSE ROUND(SUM(CASE WHEN md.reg_is_regularized = 1 THEN 1 ELSE 0 END) / CAST(SUM(CASE WHEN md.score IN (2,3,4) THEN 1 ELSE 0 END) AS FLOAT) * 100, 2)
                    END
                    AS regularization_rate'
                ),
            ])
            ->groupBy('cc.reference', 'cc.id', 'm.reference', 'm.id');

        $user = auth()->user();

        if ($fetchFilters) return $this->filters($missionsStates);
        // Business constraints for data display
        if (hasRole('ci')) {
            $missionsStates = $missionsStates->leftJoin('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id')
                ->where(fn ($query) => $query
                    ->where('m.assigned_to_ci_id', $user->id)
                    ->orWhere('mhc.user_id', $user->id)
                    ->orWhere('md.assigned_to_ci_id', $user->id)
                    ->orWhere('md.controlled_by_ci_id', $user->id)
                    ->orWhere('md.assigned_to_ci_id', $user->id));
        } elseif (hasRole('cdc')) {
            $missionsStates = $missionsStates->where('m.created_by_id', $user->id)->where('dre_id', getDre(auth()->user())->first()->id);
        } elseif (hasRole('cc')) {
            $missionsStates = $missionsStates->where(fn ($query) => $query->where('m.assigned_to_cc_id', $user->id)->orWhere('md.assigned_to_cc_id', $user->id)->orWhere('md.controlled_by_cc_id', $user->id)->orWhere('md.assigned_to_cc_id', $user->id));
        } elseif (hasRole('da')) {
            $missionsStates = $missionsStates->whereIn('m.agency_id', $user->agencies->pluck('id')->toArray())->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole('dre')) {
            $missionsStates = $missionsStates->whereIn('m.agency_id', $user->agencies->pluck('id'))->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole('cdcr')) {
            $missionsStates = $missionsStates->whereNotNull('m.cdc_validation_by_id');
        } elseif (hasRole('cc')) {
            $missionsStates = $missionsStates->whereNotNull('m.assigned_to_cc_id', $user->id)->whereNotNull('m.cdc_validation_by_id');
        } elseif (hasRole('dcp')) {
            $missionsStates = $missionsStates->whereNotNull('m.cdcr_validation_by_id');
        } elseif (hasRole('cder')) {
            $missionsStates = $missionsStates->whereNotNull('m.cdcr_validation_by_id')->where('m.assigned_to_cder_id', $user->id);
        } elseif (hasRole('ir')) {
            $missionsStates = $missionsStates->whereNotNull('m.dcp_validation_by_id')->whereIn('m.agency_id', $user->agencies->pluck('id')->toArray());
        } else {
            $missionsStates = $missionsStates->whereNotNull('m.dcp_validation_by_id');
        }

        // Search
        if ($search) $missionsStates->search(['cc.reference', 'm.reference'], $search);

        // Sort
        if ($sort) {
            $missionsStates = $missionsStates->reorder();
            if (isset($sort['campaign'])) {
                $direction = $sort['campaign'] == 'asc' ? 'asc' : 'desc';
                $missionsStates = $missionsStates->orderBy('cc_reference', $direction);
            }
            if (isset($sort['mission'])) {
                $direction = $sort['mission'] == 'asc' ? 'asc' : 'desc';
                $missionsStates = $missionsStates->orderBy('m_reference', $direction);
            }
            if (isset($sort['total_anomalies'])) {
                $direction = $sort['total_anomalies'] == 'asc' ? 'asc' : 'desc';
                $missionsStates = $missionsStates->orderByRaw(DB::raw('SUM(CASE WHEN md.score IN (2,3,4) THEN 1 ELSE 0 END)' . $direction));
            }
            if (isset($sort['total_regularized'])) {
                $direction = $sort['total_regularized'] == 'asc' ? 'asc' : 'desc';
                $missionsStates = $missionsStates->orderByRaw(DB::raw('SUM(CASE WHEN md.reg_is_regularized = 1 THEN 1 ELSE 0 END)' . $direction));
            }
            if (isset($sort['regularization_rate'])) {
                $direction = $sort['regularization_rate'] == 'asc' ? 'asc' : 'desc';
                $missionsStates = $missionsStates->orderByRaw(
                    'CASE
                    WHEN SUM(CASE WHEN md.score IN (2,3,4) THEN 1 ELSE 0 END) = 0 THEN NULL
                    ELSE ROUND(SUM(CASE WHEN md.reg_is_regularized = 1 THEN 1 ELSE 0 END) / CAST(SUM(CASE WHEN md.score IN (2,3,4) THEN 1 ELSE 0 END) AS FLOAT) * 100, 2)
                    END ' . $direction
                );
            }
        } else {
            $missionsStates = $missionsStates->orderByRaw(
                'CASE
                    WHEN SUM(CASE WHEN md.score IN (2,3,4) THEN 1 ELSE 0 END) = 0 THEN NULL
                    ELSE ROUND(SUM(CASE WHEN md.reg_is_regularized = 1 THEN 1 ELSE 0 END) / CAST(SUM(CASE WHEN md.score IN (2,3,4) THEN 1 ELSE 0 END) AS FLOAT) * 100, 2)
                END'
            );
        }

        // Filter
        if ($filter) $this->filter($missionsStates, $filter);

        $missionsStates = MissionStateResource::collection($missionsStates->paginate($perPage));

        return $missionsStates;
    }

    /**
     * Get missions states filters data
     *
     * @return array
     */
    private function filters(Builder $missionsStates): array
    {
        $campaigns = [];
        $dres = [];
        $agencies = [];

        $campaign = formatForSelect((new ControlCampaignQuery)->prepare()->query->select(['cc.reference', 'cc.id'])->whereNotNull('m.dcp_validation_at')->get()->toArray(), 'reference');
        $agency = [];
        $dre = getDre()
            ->leftJoin('agencies AS a', 'd.id', 'a.dre_id')
            ->join('missions AS m', 'a.id', 'm.agency_id')
            ->join('control_campaigns AS cc', 'cc.id', 'm.control_campaign_id');
        if (isset(request('filter')['campaign']) && !empty(request('filter')['campaign'])) {
            $campaigns = explode(',', request('filter')['campaign']);
            $dre = $dre
                ->whereIn('cc.id', $campaigns)
                ->get()
                ->toArray();
        } else {
            $dre = $dre->get()->toArray();
        }
        $dre = formatForSelect($dre, 'full_name');

        if (isset(request('filter')['dre']) && !empty(request('filter')['dre'])) {
            $dres = explode(',', request('filter')['dre']);
            $agency = getAgencies()
                ->join('missions AS m', 'a.id', 'm.agency_id')
                ->whereIn('dre_id', $dres);
            if (!empty($campaigns)) {
                $agency->join('control_campaigns AS cc', 'cc.id', 'm.control_campaign_id')->whereIn('cc.id', $campaigns);
            }
            $agency = $agency->get()->toArray();
            $agency = formatForSelect($agency, 'full_name');
        }
        return compact('campaign', 'agency', 'dre');
    }

    /**
     * Filter data
     *
     * @param Builder $missionsStates
     * @param array $filter
     *
     * @return Builder
     */
    private function filter(Builder $missionsStates, array $filters): Builder
    {

        if (isset($filters['campaign'])) {
            $campaigns = explode(',', $filters['campaign']);
            $missionsStates = $missionsStates->whereIn('cc.id', $campaigns);
        }

        if (isset($filters['dre'])) {
            $dres = explode(',', $filters['dre']);
            $missionsStates = $missionsStates->whereIn('d.id', $dres);
        }

        if (isset($filters['agency'])) {
            $agencies = explode(',', $filters['agency']);
            $missionsStates = $missionsStates->whereIn('a.id', $agencies);
        }
        return $missionsStates;
    }
}
