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
        if (!hasRole(['cc'])) {
            $missions = $missions->leftJoin('mission_details as md', 'm.id', 'md.mission_id')->groupBy('m.id');
        }

        $today = today()->format('Y-m-d');

        $active = (clone $missions)
            ->whereNotNull('md.controlled_by_ci_id')
            ->whereNull('m.cdc_validation_by_id')
            ->whereDate('m.programmed_start', '<=', $today)
            ->whereDate('m.programmed_end', '<', $today)
            ->get()->count();

        $delay = (clone $missions)
            ->where(function ($query) {
                $query->whereNull('m.cdc_validation_by_id')->orWhereNull('md.controlled_by_ci_id');
            })
            ->whereDate('m.programmed_end', '<', $today)
            ->get()->count();

        $done = (clone $missions);
        if (hasRole('cdc')) {
            $done = $done->whereNotNull('m.ci_validation_by_id');
        } else {
            $done = $done->whereNotNull('m.cdc_validation_by_id');
        }
        $done = $done->get()->count();

        $todo = (clone $missions)
            ->whereNull('md.controlled_by_ci_id')
            ->whereDate('m.programmed_start', '<=', $today)
            // ->groupBy('m.id')
            ->get()->count();
        // dd($todo, $active, $done, $delay);
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
            ->select(['f.name as family', DB::raw('FORMAT(AVG(score), 2) as score')])
            ->join('control_points as cp', 'cp.id', 'md.control_point_id')
            ->join('processes as p', 'p.id', 'cp.process_id')
            ->join('domains as dm', 'dm.id', 'p.domain_id')
            ->join('families as f', 'f.id', 'dm.family_id')
            ->groupBy(['family'])->get()->map(fn ($data) => [$data->family => $data->score])->collapse();
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
            ->select(['dm.name as domain', DB::raw('FORMAT(AVG(score), 2) as avg_score')])
            ->join('control_points as cp', 'cp.id', 'md.control_point_id')
            ->join('processes as p', 'p.id', 'cp.process_id')
            ->join('domains as dm', 'dm.id', 'p.domain_id')
            ->groupBy(['domain'])->orderBy('avg_score', 'ASC')->get()->toArray();
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
                ->select(DB::raw('CONCAT(d.code, " - ", d.name) as dre_name'), DB::raw('CONCAT(a.code, " - ", a.name) as agency_name'), 'm.reference')
                ->leftJoin('agencies as a', 'a.dre_id', 'd.id')
                ->join('missions as m', 'm.agency_id', 'a.id')
                ->where(DB::raw(('CONCAT(d.code, " - ", d.name)')), $dre);
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
            ->groupBy(['m.id'])
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
            ->groupBy('family')
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
            ->groupBy('domain')
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
            ->groupBy('dre')
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
            ->select(DB::raw('COUNT(*) as total_anomalies'), DB::raw('CONCAT(a.code, " - ", a.name) as agency'))
            ->where('md.score', '>', 1)
            ->groupBy('agency')
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
            ->groupBy('m.id')
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
            ->groupBy('family')
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
            ->groupBy('domain')
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
            ->groupBy('dre')
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
            ->select(DB::raw('COUNT(*) as total_major_facts'), DB::raw('CONCAT(a.code, " - ", a.name) as agency'))
            ->where('md.major_fact', true)
            ->groupBy('agency')
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
            ->select('c.reference as campaign')
            ->join('missions as m', 'c.id', 'm.control_campaign_id');

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

        $campaigns = $campaigns->whereNotNull('validated_at')->groupBy('campaign');
        return $campaigns;
    }

    /**
     * Fetch Mission Details
     *
     * @return Builder
     */
    private function getDetails()
    {
        $details = DB::table('mission_details as md')
            ->select(['m.id', 'm.reference', DB::raw('CONCAT(d.code, " - ", d.name) as dre'), DB::raw('CONCAT(a.code, " - ", a.name) as agency'), 'md.score'])
            ->whereNotNull('md.score')
            ->join('missions as m', 'm.id', 'md.mission_id')
            ->join('agencies as a', 'a.id', 'm.agency_id')
            ->join('dres as d', 'd.id', 'a.dre_id');
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
        $missions = DB::table('missions as m')
            ->select(['m.id', 'm.reference', DB::raw('CONCAT(d.code, " - ", d.name) as dre'), DB::raw('CONCAT(a.code, " - ", a.name) as agency')])
            ->join('agencies as a', 'a.id', 'm.agency_id')
            ->join('dres as d', 'd.id', 'a.dre_id');
        $user = auth()->user();
        if (hasRole('ci')) {
            $missions = $missions->join('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id')->where('mhc.user_id', $user->id);
        } elseif (hasRole('cdc')) {
            $missions = $missions->where('m.created_by_id', $user->id);
        } elseif (hasRole('cc')) {
            $missions = $missions->join('mission_details as md', 'md.mission_id', 'm.id')->where('md.assigned_to_cc_id', $user->id);
        } elseif (hasRole('da')) {
            $missions = $missions->whereIn('m.agency_id', $user->agencies->pluck('id'))->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole('dre')) {
            $missions = $missions->whereIn('m.agency_id', $user->agencies->pluck('id'))->whereNotNull('m.dcp_validation_by_id');
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
