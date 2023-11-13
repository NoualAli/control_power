<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    /**
     * Anomalies section
     *
     * @return array
     */
    public function anomalies(): array
    {
        $missionsAnomalies = $this->missionsAnomalies();
        $campaignsAnomalies = $this->campaignsAnomalies();
        $familiesAnomalies = $this->familiesAnomalies();
        $domainsAnomalies = $this->domainsAnomalies();
        $dresAnomalies = $this->dresAnomalies();
        $agenciesAnomalies = $this->agenciesAnomalies();
        return compact(
            'missionsAnomalies',
            'campaignsAnomalies',
            'familiesAnomalies',
            'domainsAnomalies',
            'dresAnomalies',
            'agenciesAnomalies',
        );
    }

    /**
     * Major Facts data section
     *
     * @return array
     */
    public function majorFacts(): array
    {
        $missionsMajorFacts = $this->missionsMajorFacts();
        $campaignsMajorFacts = $this->campaignsMajorFacts();
        $familiesMajorFacts = $this->familiesMajorFacts();
        $domainsMajorFacts = $this->domainsMajorFacts();
        $dresMajorFacts = $this->dresMajorFacts();
        $agenciesMajorFacts = $this->agenciesMajorFacts();
        return compact(
            'missionsMajorFacts',
            'campaignsMajorFacts',
            'familiesMajorFacts',
            'dresMajorFacts',
            'domainsMajorFacts',
            'agenciesMajorFacts',
        );
    }

    /**
     * Regularizations data section
     *
     * @return array
     */
    public function regularizations(): array
    {
        return [];
    }

    /**
     * Scores data section
     *
     * @return array
     */
    public function scores(): array
    {
        $avgScoreByDre = $this->avgScoreByDre();
        $avgScoreByFamily = $this->avgScoreByFamily();
        $avgScoreByDomain = $this->avgScoreByDomain();
        $globalScores = $this->globalScores();
        return compact(
            'avgScoreByDre',
            'avgScoreByFamily',
            'avgScoreByDomain',
            'globalScores',
        );
    }


    public function realisationStates()
    {
        $dresClassificationByAchievementRate = $this->dresClassificationByAchievementRate();
        $missionsPercentage = $this->missionsPercentage();
        $missionsState = $this->missionsState();
        return compact(
            'dresClassificationByAchievementRate',
            'missionsPercentage',
            'missionsState',
        );
    }

    /**
     * Fetch missions states
     *
     * @return array
     */
    private function missionsState(): array
    {
        $missions = $this->getMissions()->select('m.id');
        $today = today()->format('Y-m-d');
        $missions = $missions->select(
            DB::raw('SUM(CASE WHEN m.current_state = 1 THEN 1 ELSE 0 END) as todo'),
            DB::raw('SUM(CASE WHEN m.current_state = 2 OR m.current_state = 4 THEN 1 ELSE 0 END) as active'),
            DB::raw('SUM(CASE WHEN m.current_state = 9 THEN 1 ELSE 0 END) as delay'),
            DB::raw('SUM(CASE WHEN m.current_state = 5 OR m.current_state = 6 OR m.current_state = 7 OR m.current_state = 8 THEN 1 ELSE 0 END) as done'),
        )->get()->first();
        $todo = $missions->todo;
        $done = $missions->done;
        $delay = $missions->delay;
        $active = $missions->active;
        return compact('delay', 'active', 'todo', 'done');
    }

    /**
     * Fetch scores statistics
     *
     * @return array
     */
    private function globalScores(): array
    {
        extract($this->defaultColors());
        $details = $this->getDetails()->select(['score', DB::raw('COUNT(*) as scores_count')])->whereNotNull('score');
        $groupBy = ['score'];
        if (hasRole(['ci'])) {
            $details = $details->addSelect('mhc.user_id');
            $groupBy = ['score', 'mhc.user_id'];
        }
        if (hasRole(['cdc'])) {
            $details = $details->addSelect('created_by_id');
            $groupBy = ['score', 'created_by_id'];
        }

        $details = $details->groupBy($groupBy);
        $details = $details->orderBy('score', 'DESC')->get()->pluck('scores_count', 'score');
        $labels = $details->keys();
        $datasets = [
            [
                'axis' => 'y',
                "label" => "Classement des notations",
                "data" => $details->values(),
                'backgroundColor' => $backgroundColor,
                'borderColor' => $borderColor,
                'borderWidth' => $borderWidth,
            ]
        ];
        return compact('labels', 'datasets');
    }

    /**
     * Get avg scores for each dre
     *
     * @return array
     */
    private function avgScoreByDre(): array
    {
        $scores = $this->getDetails()->get()->groupBy('dre')->map(function ($groupedDetails) {
            return [
                'dre' => $groupedDetails->first()->dre,
                'avg_score' => number_format($groupedDetails->avg('score'), 2)
            ];
        })->sortBy('avg_score')
            ->values()->toArray();
        return array_values($scores);
    }

    /**
     * Get avg scores for each family
     *
     * @return array
     */
    private function avgScoreByFamily(): array
    {
        $families = $this->getDetails()
            ->select(['f.name as family', DB::raw('CAST(ROUND(AVG(CAST(md.score AS DECIMAL(10, 2))), 2) AS VARCHAR(10)) as avg_score')])
            ->join('control_points as cp', 'cp.id', 'md.control_point_id')
            ->join('processes as p', 'p.id', 'cp.process_id')
            ->join('domains as dm', 'dm.id', 'p.domain_id')
            ->join('families as f', 'f.id', 'dm.family_id')
            ->groupBy(['f.name'])->get()->map(fn ($data) => [$data->family => number_format($data->avg_score, 2)])->collapse();
        $labels = $families->keys();

        extract($this->defaultColors());
        $datasets = [
            [
                "label" => "Anomalies par mission",
                "data" => $families->values(),
                'backgroundColor' => $backgroundColor,
                'borderColor' => $borderColor,
                'borderWidth' => $borderWidth,
            ]
        ];
        return compact('labels', 'datasets');
    }

    /**
     * Get avg scores for each domain
     *
     * @return array
     */
    private function avgScoreByDomain(): array
    {
        $domains = $this->getDetails()
            ->select(['dm.name as domain', DB::raw('CAST(ROUND(AVG(CAST(md.score AS DECIMAL(10, 2))), 2) AS VARCHAR(10)) as avg_score')])
            ->join('control_points as cp', 'cp.id', 'md.control_point_id')
            ->join('processes as p', 'p.id', 'cp.process_id')
            ->join('domains as dm', 'dm.id', 'p.domain_id')
            ->groupBy(['dm.name'])->orderBy('avg_score', 'DESC')->get()->map(fn ($item) => ['domain' => $item->domain, 'avg_score' => number_format($item->avg_score, 2)])->toArray();
        return $domains;
    }


    /**
     * Fetch dres classification by achievement rate
     *
     * @return array
     */
    private function dresClassificationByAchievementRate(): array
    {
        $missions = $this->getMissions()->get()->groupBy('dre');
        $achievments = [];
        foreach ($missions as $dre => $missions) {
            $dreMissions = DB::table('dres as d')
                ->select(DB::raw("CONCAT(d.code, ' - ', d.name) as dre_name"), DB::raw("CONCAT(a.code, ' - ', a.name) as agency_name"), 'm.reference')
                ->leftJoin('agencies as a', 'a.dre_id', 'd.id')
                ->join('missions as m', 'm.agency_id', 'a.id')
                ->where(DB::raw("CONCAT(d.code, ' - ', d.name)"), $dre);
            $totalAchieved = (clone $dreMissions)->whereNotNull('m.cdc_validation_by_id')->count();
            $total = (clone $dreMissions)->count();
            $rate = $total ? number_format(($totalAchieved * 100) / $total, 2) : 0;
            array_push($achievments, ['dre' => $dre, 'total' => $total, 'totalAchieved' => $totalAchieved, 'rate' => $rate]);
        }
        usort($achievments, function ($a, $b) {
            if ($a['rate'] != $b['rate']) {
                return $b['rate'] <=> $a['rate']; // Tri par rapport à rate
            } elseif ($a['totalAchieved'] != $b['totalAchieved']) {
                return $b['totalAchieved'] <=> $a['totalAchieved']; // Si rate est le même, tri par rapport à totalAchieved
            } else {
                return $b['total'] <=> $a['total']; // Si rate et totalAchieved sont les mêmes, tri par rapport à total
            }
        });

        return $achievments;
    }

    /**
     * Fetch missions validations statistics
     *
     * @return array
     */
    private function missionsPercentage(): array
    {
        $missions = $this->getMissions();
        $total = $missions->count();
        $validated = $missions->whereNotNull('cdc_validation_by_id')->count();
        $notValidated = ($total - $validated);

        $labels = ['Rapports validés', 'Rapports non validés'];
        extract($this->defaultColors());
        $datasets = [
            [
                "label" => "",
                "data" => [$validated, $notValidated],
                'backgroundColor' => $backgroundColor,
                'borderColor' => $borderColor,
                'borderWidth' => $borderWidth,
            ]
        ];
        return compact('labels', 'datasets');
    }
    /**
     * Fetch mission anomalies statistics
     *
     * @return array
     */
    private function missionsAnomalies(): array
    {
        $missions = $this->getMissions()
            ->select(DB::raw('COUNT(*) as total_anomalies'), 'm.reference as mission');
        if (!hasRole('cc')) {
            $missions = $missions->join('mission_details as md', 'md.mission_id', 'm.id');
        }
        $missions = $missions->where('md.score', '>', 1)
            ->groupBy(['m.reference'])
            ->orderBy('total_anomalies', 'DESC')
            ->take(10)
            ->get()
            ->toArray();
        return $missions;
    }
    /**
     * Fetch campaigns anomalies statistics
     *
     * @return array
     */
    private function campaignsAnomalies(): array
    {
        $campaigns = $this->getCampaigns()
            ->addSelect(DB::raw('COUNT(md.score) as total_anomalies'))
            ->join('mission_details as md', 'm.id', 'md.mission_id')
            ->where('md.score', '>', 1)
            ->orderBy('total_anomalies', 'DESC')
            ->take(10)
            ->get()
            ->toArray();

        return array_values($campaigns);
    }

    /**
     * Fetch families anomalies statistics
     *
     * @return array
     */
    private function familiesAnomalies(): array
    {
        $anomalies = $this->getDetails()
            ->select(DB::raw('COUNT(*) as count'), 'f.name as family')
            ->join('control_points as cp', 'cp.id', '=', 'md.control_point_id')
            ->join('processes as p', 'p.id', '=', 'cp.process_id')
            ->join('domains as dm', 'dm.id', '=', 'p.domain_id')
            ->join('families as f', 'f.id', '=', 'dm.family_id')
            ->where('md.score', '>', 1)
            ->groupBy('f.name')
            ->orderBy('count', 'DESC')
            ->get();
        $anomalies = $anomalies->mapWithKeys(function ($data, $key) {
            $familyName = $data->family;
            return [$familyName => $data->count];
        });
        $labels = $anomalies->keys();

        extract($this->defaultColors());
        $datasets = [
            [
                "label" => "Anomalies par familles",
                "data" => $anomalies->values(),
                'backgroundColor' => $backgroundColor,
                'borderColor' => $borderColor,
                'borderWidth' => $borderWidth,
            ]
        ];
        return compact('labels', 'datasets');
    }

    /**
     * Fetch domains anomalies statistics
     *
     * @return array
     */
    private function domainsAnomalies(): array
    {
        $anomalies = $this->getDetails()
            ->select(DB::raw('COUNT(*) as total_anomalies'), 'dm.name as domain')
            ->join('control_points as cp', 'cp.id', '=', 'md.control_point_id')
            ->join('processes as p', 'p.id', '=', 'cp.process_id')
            ->join('domains as dm', 'dm.id', '=', 'p.domain_id')
            ->where('md.score', '>', 1)
            ->groupBy('dm.name')
            ->orderBy('total_anomalies', 'DESC')
            ->take(10)
            ->get();
        return $anomalies->toArray();
    }

    /**
     * Fetch dres anomalies statistics
     *
     * @return array
     */
    private function dresAnomalies(): array
    {
        $anomalies = $this->getDetails()
            ->select(DB::raw('COUNT(*) as count'), 'd.name as dre')
            ->where('md.score', '>', 1)
            ->groupBy('d.name')
            ->get()->mapWithKeys(function ($data, $key) {
                $dre = $data->dre;
                return [$dre => $data->count];
            });
        $labels = $anomalies->keys();
        extract($this->defaultColors());
        $datasets = [
            [
                "label" => "Anomalies par DRE",
                "data" => $anomalies->values(),
                'backgroundColor' => $backgroundColor,
                'borderColor' => $borderColor,
                'borderWidth' => $borderWidth,
            ]
        ];
        return compact('labels', 'datasets');
    }

    /**
     * Fetch agencies anomalies statistics
     *
     * @return array
     */
    private function agenciesAnomalies(): array
    {
        $anomalies = $this->getDetails()
            ->select(DB::raw('COUNT(*) as total_anomalies'), DB::raw("CONCAT(a.code, ' - ', a.name) as agency"))
            ->where('md.score', '>', 1)
            ->groupBy(DB::raw("CONCAT(a.code, ' - ', a.name)"))
            ->orderBy('total_anomalies', 'DESC')
            ->take(10)
            ->get()->toArray();
        return array_values($anomalies);
    }

    /**
     * Fetch mission major facts statistics
     *
     * @return array
     */
    private function missionsMajorFacts(): array
    {
        $missions = $this->getMissions()->select(DB::raw('COUNT(md.major_fact) as total_major_facts'), 'm.reference as mission');
        if (!hasRole('cc')) {
            $missions = $missions->join('mission_details as md', 'md.mission_id', 'm.id');
        }
        $missions = $missions
            ->where('md.major_fact', true)
            ->groupBy('m.reference')
            ->orderBy('total_major_facts', 'DESC')
            ->take(10)
            ->get()
            ->toArray();
        return array_values($missions);
    }
    /**
     * Fetch campaigns major facts statistics
     *
     * @return array
     */
    private function campaignsMajorFacts(): array
    {
        $campaigns = $this->getCampaigns()
            ->addSelect(DB::raw('COUNT(md.id) as total_major_facts'))
            ->join('mission_details as md', 'm.id', 'md.mission_id')
            ->where('md.major_fact', true)
            ->orderBy('total_major_facts', 'DESC')
            ->take(10)
            ->get()
            ->toArray();
        return array_values($campaigns);
    }

    /**
     * Fetch families major facts statistics
     *
     * @return array
     */
    private function familiesMajorFacts(): array
    {
        $majorFacts = $this->getDetails()
            ->select(DB::raw('COUNT(*) as count'), 'f.name as family')
            ->join('control_points as cp', 'cp.id', '=', 'md.control_point_id')
            ->join('processes as p', 'p.id', '=', 'cp.process_id')
            ->join('domains as dm', 'dm.id', '=', 'p.domain_id')
            ->join('families as f', 'f.id', '=', 'dm.family_id')
            ->where('md.major_fact', true)
            ->groupBy('f.name')
            ->orderBy('count', 'DESC')
            ->get();

        $majorFacts = $majorFacts->mapWithKeys(function ($data, $key) {
            $familyName = $data->family;
            return [$familyName => $data->count];
        });

        $labels = $majorFacts->keys();
        extract($this->defaultColors());
        $datasets = [
            [
                "label" => "Faits majeur par familles",
                "data" => $majorFacts->values(),
                'backgroundColor' => $backgroundColor,
                'borderColor' => $borderColor,
                'borderWidth' => $borderWidth,
            ]
        ];
        return compact('labels', 'datasets');
    }

    /**
     * Fetch domains major facts statistics
     *
     * @return array
     */
    private function domainsMajorFacts(): array
    {
        $domains = $this->getDetails()
            ->select(DB::raw('COUNT(md.id) as total_major_facts'), 'dm.name as domain')
            ->join('control_points as cp', 'cp.id', '=', 'md.control_point_id')
            ->join('processes as p', 'p.id', '=', 'cp.process_id')
            ->join('domains as dm', 'dm.id', '=', 'p.domain_id')
            ->where('md.major_fact', true)
            ->groupBy('dm.name')
            ->orderBy('total_major_facts', 'DESC')
            ->take(10)
            ->get();

        return $domains->toArray();
    }

    /**
     * Fetch dres major facts statistics
     *
     * @return array
     */
    private function dresMajorFacts(): array
    {
        $majorFacts = $this->getDetails()
            ->select(DB::raw('COUNT(md.id) as count'), 'd.name as dre')
            ->where('md.major_fact', true)
            ->groupBy('d.name')
            ->get()->mapWithKeys(function ($data, $key) {
                $dre = $data->dre;
                return [$dre => $data->count];
            });
        $labels = $majorFacts->keys();
        extract($this->defaultColors());
        $datasets = [
            [
                "label" => "Faits majeur par DRE",
                "data" => $majorFacts->values(),
                'backgroundColor' => $backgroundColor,
                'borderColor' => $borderColor,
                'borderWidth' => $borderWidth,
            ]
        ];
        return compact('labels', 'datasets');
    }

    /**
     * Fetch agencies major facts statistics
     *
     * @return array
     */
    private function agenciesMajorFacts(): array
    {
        $majorFacts = $this->getDetails()
            ->select(DB::raw('COUNT(*) as total_major_facts'), DB::raw("CONCAT(a.code, ' - ', a.name) as agency"))
            ->where('md.major_fact', true)
            ->groupBy(DB::raw("CONCAT(a.code, ' - ', a.name)"))
            ->orderBy('total_major_facts', 'DESC')
            ->take(10)
            ->get()->toArray();
        return array_values($majorFacts);
    }

    /**
     * Fetch Control Campaigns
     *
     * @return Builder
     */
    private function getCampaigns()
    {
        $campaigns = DB::table('control_campaigns as c')
            ->select('c.reference as campaign', 'c.id as campaign_id')
            ->join('missions as m', 'c.id', 'm.control_campaign_id');

        // if (request()->has('onlyCurrentCampaign')) {
        //     $campaigns = $this->getCampaigns()->whereNotNull('validated_at')->orderBy('id', 'DESC')->first();
        // }

        $user = auth()->user();
        if (hasRole('ci')) {
            $campaigns = $campaigns->join('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id')->where('mhc.user_id', $user->id);
        } elseif (hasRole('cdc')) {
            $campaigns = $campaigns->where('m.created_by_id', $user->id);
        } elseif (hasRole('cc')) {
            $campaigns = $campaigns->where('md.assigned_to_cc_id', $user->id);
        } elseif (hasRole('da')) {
            $campaigns = $campaigns->whereIn('m.agency_id', $user->agencies->pluck('id'))->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole('dre')) {
            $campaigns = $campaigns->whereIn('m.agency_id', $user->agencies->pluck('id'))->whereNotNull('m.dcp_validation_by_id');
        }

        $campaigns = $campaigns->whereNotNull('validated_at')->groupBy('c.reference', 'c.id');
        return $campaigns;
    }

    /**
     * Fetch Mission Details
     *
     * @return Builder
     */
    private function getDetails()
    {
        $columns = ['m.id', 'm.reference', DB::raw('CONCAT(d.code, " - ", d.name) as dre'), DB::raw('CONCAT(a.code, " - ", a.name) as agency'), 'md.score', 'm.control_campaign_id'];
        if (env('DB_CONNECTION') == 'sqlsrv') {
            $columns = ['m.id', 'm.reference', DB::raw("CONCAT(d.code, ' - ', d.name) as dre"), DB::raw("CONCAT(a.code, ' - ', a.name) as agency"), 'md.score', 'm.control_campaign_id'];
        }

        $details = DB::table('mission_details as md')
            ->select($columns)
            ->whereNotNull('md.score')
            ->join('missions as m', 'm.id', 'md.mission_id')
            ->join('agencies as a', 'a.id', 'm.agency_id')
            ->join('dres as d', 'd.id', 'a.dre_id');

        if (request()->has('onlyCurrentCampaign')) {
            $currentCampaign = $this->getCampaigns()->whereNotNull('validated_at')->orderBy('c.id', 'DESC')->first();
            if ($currentCampaign) {
                $details = $details->where('m.control_campaign_id', $currentCampaign?->campaign_id);
            }
        }
        $user = auth()->user();
        if (hasRole('ci')) {
            $details = $details->join('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id')->where('mhc.user_id', $user->id);
        } elseif (hasRole('cdc')) {
            $details = $details->where('m.created_by_id', $user->id);
        } elseif (hasRole('cc')) {
            $details = $details->where('md.assigned_to_cc_id', $user->id);
        } elseif (hasRole('da')) {
            $details = $details->whereIn('m.agency_id', $user->agencies->pluck('id'))->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole('dre')) {
            $details = $details->whereIn('m.agency_id', $user->agencies->pluck('id'))->whereNotNull('m.dcp_validation_by_id');
        }
        return $details;
    }

    /**
     * Fetch Missions
     *
     * @return Builder
     */
    private function getMissions()
    {
        $columns = ['m.id', 'm.reference', DB::raw('CONCAT(d.code, " - ", d.name) as dre'), DB::raw('CONCAT(a.code, " - ", a.name) as agency'), 'm.control_campaign_id'];
        if (env('DB_CONNECTION') == 'sqlsrv') {
            $columns = ['m.id', 'm.reference', DB::raw("CONCAT(d.code, ' - ', d.name) as dre"), DB::raw("CONCAT(a.code, ' - ', a.name) as agency"), 'm.control_campaign_id'];
        }
        $missions = DB::table('missions as m')
            ->select($columns)
            ->join('agencies as a', 'a.id', 'm.agency_id')
            ->join('dres as d', 'd.id', 'a.dre_id');

        if (request()->has('onlyCurrentCampaign')) {
            $currentCampaign = $this->getCampaigns()->whereNotNull('validated_at')->orderBy('c.id', 'DESC')->first();
            if ($currentCampaign) {
                $missions = $missions->where('m.control_campaign_id', $currentCampaign?->campaign_id);
            }
        }
        $user = auth()->user();
        if (hasRole('ci')) {
            $missions = $missions->join('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id')->where('mhc.user_id', $user->id);
        } elseif (hasRole('cdc')) {
            $missions = $missions->where('m.created_by_id', $user->id);
        } elseif (hasRole('cc')) {
            $missions = $missions->join('mission_details as md', 'md.mission_id', 'm.id')->where('md.assigned_to_cc_id', $user->id);
        } elseif (hasRole('da')) {
            $missions = $missions->whereIn('m.agency_id', $user->agencies->pluck('id'));
        } elseif (hasRole('dre')) {
            $missions = $missions->whereIn('m.agency_id', $user->agencies->pluck('id'));
        }

        return $missions;
    }

    /**
     * Colors config for charts
     *
     * @return array
     */
    private function defaultColors(): array
    {
        return [
            'backgroundColor' => [
                'rgba(54, 162, 235, .7)',
                'rgba(255, 99, 132, .7)',
                'rgba(255, 206, 86, .7)',
                'rgba(255, 159, 64, .7)',
                'rgba(75, 192, 192, .7)',
                'rgba(153, 102, 255,.7)',
            ],
            'borderColor' => [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255,1)',
            ],
            'borderWidth' => 1
        ];
    }
}
