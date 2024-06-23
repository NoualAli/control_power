<?php

namespace App\Statistics\AgencyLevel;

use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

class StatisticsData
{
    public function __get($key)
    {
        $method = explode('_', $key);
        $method = array_map(function ($item) {
            return ucfirst(strtolower($item));
        }, $method);
        $method = 'get' . implode('', $method);
        if (method_exists($this, $method)) {
            return $this->$method();
        } else {
            return collect([]);
        }
    }

    /**
     * Fetch latest/active control campaign
     *
     * @return Object
     */
    protected function getCurrentCampaign()
    {
        $campaign = DB::table('control_campaigns as cc')->where('cc.is_for_testing', false)->whereNotNull('cc.validated_at');
        $today = today();
        $campaign =  $campaign->where(function ($query) use ($today) {
            $query->whereDate('start_date', '<=', $today)
                ->orWhereDate('end_date', '<=', $today);
            // ->orWhere(function ($query) use ($today) {
            //     // Handle cases where start_date is in the future but end_date is today
            //     $query->whereDate('start_date', '>=', $today)
            //         ->whereDate('end_date', '=', $today);
            // });
        })->orderBy('cc.end_date', 'DESC');
        // dd($campaign->get()->first());
        if (!$campaign->count()) {
            $campaign = DB::table('control_campaigns as cc')->where('cc.is_for_testing', false)->whereNotNull('cc.validated_at')->orderBy('cc.start_date', 'DESC');
        }
        return $campaign->get()->first();
    }

    /**
     * Fetch Control Campaigns
     *
     * @return Builder
     */
    protected function getCampaigns()
    {
        $campaigns = DB::table('control_campaigns as c')
            ->select('c.reference as campaign', 'c.id as campaign_id')
            ->leftJoin('missions as m', 'c.id', 'm.control_campaign_id');

        $user = auth()->user();
        if (hasRole('ci')) {
            $campaigns = $campaigns->leftJoin('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id')
                ->where(fn ($query) => $query->where('m.assigned_to_ci_id', $user->id)->orWhere('mhc.user_id', $user->id));
        } elseif (hasRole('cdc')) {
            $campaigns = $campaigns->where('m.created_by_id', $user->id);
        } elseif (hasRole('da')) {
            $campaigns = $campaigns->whereIn('m.agency_id', $user->agencies->pluck('id'))->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole('dre')) {
            $campaigns = $campaigns->whereIn('m.agency_id', $user->agencies->pluck('id'))->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole('cder')) {
            $campaigns = $campaigns->where('m.assigned_to_cder_id', $user->id);
        } elseif (hasRole('ir')) {
            $campaigns = $campaigns->whereIn('m.agency_id', $user->agencies->pluck('id'));
        }
        $campaigns = $campaigns->whereNotNull('c.validated_at')->where('c.is_for_testing', false);

        if (request()->has('campaign')) {
            $campaign = request('campaign');
            $campaigns = $campaigns->where('c.id', $campaign);
        } else {
            abort(422, "L'identifiant de la campagne n'est pas spécifier.");
        }

        $campaigns = $campaigns->groupBy('c.reference', 'c.id');

        return $campaigns;
    }

    /**
     * Fetch Mission Details
     *
     * @return Builder
     */
    protected function getDetails()
    {
        $columns = ['m.id', 'm.reference', DB::raw("CONCAT(d.code, ' - ', d.name) as dre"), DB::raw("CONCAT(a.code, ' - ', a.name) as agency"), 'md.score', 'm.control_campaign_id'];

        $details = DB::table('mission_details as md')
            ->select($columns)
            ->whereNotNull('md.score')
            ->where('md.is_disabled', false)
            ->join('missions as m', 'm.id', 'md.mission_id')
            ->join('agencies as a', 'a.id', 'm.agency_id')
            ->join('dres as d', 'd.id', 'a.dre_id');

        if (request()->has('campaign')) {
            $campaign = request('campaign');
            $details = $details->where('m.control_campaign_id', $campaign);
        } else {
            abort(422, "L'identifiant de la campagne n'est pas spécifier.");
        }


        $user = auth()->user();
        if (hasRole('ci')) {
            $details = $details->leftJoin('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id')
                ->where(fn ($query) => $query->where('m.assigned_to_ci_id', $user->id)->orWhere('mhc.user_id', $user->id)->orWhere('md.controlled_by_ci_id', $user->id));
        } elseif (hasRole('cdc')) {
            $details = $details->where('m.created_by_id', $user->id);
        } elseif (hasRole('cc')) {
            $details = $details->where('m.assigned_to_cc_id', $user->id);
        } elseif (hasRole('da')) {
            $details = $details->whereIn('m.agency_id', $user->agencies->pluck('id'))->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole('dre')) {
            $details = $details->whereIn('m.agency_id', $user->agencies->pluck('id'))->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole('cder')) {
            $details = $details->where('m.assigned_to_cder_id', $user->id);
        } elseif (hasRole('ir')) {
            $details = $details->whereIn('m.agency_id', $user->agencies->pluck('id')->toArray())->whereNotNull('m.dcp_validation_by_id');
        }
        $details = $details
            ->where('md.is_disabled', false)
            ->where('m.is_for_testing', false);
        return $details;
    }

    /**
     * Fetch Mission Details
     *
     * @return Builder
     */
    protected function getMajorFacts()
    {
        $columns = ['m.id', 'c.reference', 'm.reference', DB::raw("CONCAT(d.code, ' - ', d.name) as dre"), DB::raw("CONCAT(a.code, ' - ', a.name) as agency"), 'md.score', 'm.control_campaign_id'];
        $details = DB::table('mission_details as md')
            ->select($columns)
            ->whereNotNull('md.score')
            ->join('missions as m', 'm.id', 'md.mission_id')
            ->join('control_campaigns as c', 'c.id', 'm.control_campaign_id')
            ->join('agencies as a', 'a.id', 'm.agency_id')
            ->join('dres as d', 'd.id', 'a.dre_id');

        if (request()->has('campaign')) {
            $campaign = request('campaign');
            $details = $details->where('m.control_campaign_id', $campaign);
        } else {
            abort(422, "L'identifiant de la campagne n'est pas spécifier.");
        }

        $user = auth()->user();
        if (hasRole('ci')) {
            $details = $details->leftJoin('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id')
                ->where(fn ($query) => $query->where('m.assigned_to_ci_id', $user->id)->orWhere('mhc.user_id', $user->id)->orWhere('md.controlled_by_ci_id', $user->id));
        } elseif (hasRole('cdc')) {
            $details = $details->where('m.created_by_id', $user->id);
        } elseif (hasRole('cc')) {
            $details = $details->where('m.assigned_to_cc_id', $user->id);
        } elseif (hasRole('da')) {
            $details = $details->whereIn('m.agency_id', $user->agencies->pluck('id'))->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole('dre')) {
            $details = $details->whereIn('m.agency_id', $user->agencies->pluck('id'))->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole('ir')) {
            $details = $details->whereNotNull('md.major_fact_is_dispatched_at')->whereIn('m.agency_id', $user->agencies->pluck('id')->toArray());
        } elseif (hasRole('cder')) {
            $details = $details->where('m.assigned_to_cder_id', $user->id);
        }

        // if (hasRole(['dcp', 'cdcr', 'cc', 'cdrcp'])) {
        //     $details = $details->whereNotNull('md.major_fact_is_dispatched_to_dcp_at');
        // } elseif (hasRole(['dg', 'ig', 'iga', 'sg', 'der', 'deac', 'dga'])) {
        //     $details = $details->whereNotNull('md.major_fact_is_dispatched_at');
        // }

        $details = $details->whereNotNull('md.major_fact_is_dispatched_at')
            ->where('md.is_disabled', false)
            ->where('m.is_for_testing', false);

        // $details = $details->groupBy('c.reference');
        return $details;
    }

    /**
     * Fetch Missions
     *
     * @return Builder
     */
    protected function getMissions()
    {
        $columns = ['m.id', 'm.reference', DB::raw("CONCAT(d.code, ' - ', d.name) as dre"), DB::raw("CONCAT(a.code, ' - ', a.name) as agency"), 'm.control_campaign_id'];
        $missions = DB::table('missions as m')
            ->select($columns)
            ->join('agencies as a', 'a.id', 'm.agency_id')
            ->join('dres as d', 'd.id', 'a.dre_id');

        if (request()->has('campaign')) {
            $campaign = request('campaign');
            $missions = $missions->where('m.control_campaign_id', $campaign);
        } else {
            // return actionResponse(false, '', "L'identifiant de la campagne n'est pas spécifier.", 422);
            // abort(422, "L'identifiant de la campagne n'est pas spécifier.");
            throw new Exception("L'identifiant de la campagne n'est pas spécifier.", 422);
        }

        $user = auth()->user();

        if (hasRole('ci')) {
            $missions = $missions->leftJoin('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id')->where(fn ($query) => $query->where('m.assigned_to_ci_id', $user->id)->orWhere('mhc.user_id', $user->id));
        } elseif (hasRole('cdc')) {
            $missions = $missions->where('m.created_by_id', $user->id);
        } elseif (hasRole('cc')) {
            $missions = $missions->where(function ($query) use ($user) {
                $query->where('m.assigned_to_cc_id', $user->id);
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
        $missions = $missions->where('m.is_for_testing', false);

        return $missions;
    }


    /**
     * Colors config for charts
     *
     * @return stdClass
     */
    protected function getDefaultColors(): stdClass
    {
        $colors = new stdClass;

        $colors->backgroundColor = [
            'rgba(54, 162, 235, .7)',
            'rgba(255, 99, 132, .7)',
            'rgba(255, 206, 86, .7)',
            'rgba(255, 159, 64, .7)',
            'rgba(75, 192, 192, .7)',
            'rgba(153, 102, 255,.7)',
        ];
        $colors->borderColor = [
            'rgba(54, 162, 235, 1)',
            'rgba(255, 99, 132, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255,1)',
        ];
        $colors->borderWidth = 1;

        return $colors;
    }
}