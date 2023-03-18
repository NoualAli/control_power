<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\ControlCampaign;
use App\Models\Mission;
use App\Models\MissionDetail;
use Illuminate\Database\Eloquent\Builder;
use Throwable;

class DataController extends Controller
{
    public function anomalies()
    {
        $missionsAnomalies = $this->missionsAnomalies();
        $campaignsAnomalies = $this->campaignsAnomalies();
        $familiesAnomalies = $this->familiesAnomalies();
        $domainsAnomalies = $this->domainsAnomalies();
        $dresAnomalies = $this->dresAnomalies();
        $agenciesAnomalies = $this->agenciesAnomalies();
        // $processesAnomalies = $this->processesAnomalies();
        // $controlPointsAnomalies = $this->controlPointsAnomalies();
        return compact(
            'missionsAnomalies',
            'campaignsAnomalies',
            'familiesAnomalies',
            'domainsAnomalies',
            'dresAnomalies',
            'agenciesAnomalies',
            // 'processesAnomalies',
            // 'controlPointsAnomalies',
        );
    }
    public function majorFacts()
    {
        $missionsMajorFacts = $this->missionsMajorFacts();
        $campaignsMajorFacts = $this->campaignsMajorFacts();
        $familiesMajorFacts = $this->familiesMajorFacts();
        $domainsMajorFacts = $this->domainsMajorFacts();
        $dresMajorFacts = $this->dresMajorFacts();
        $agenciesMajorFacts = $this->agenciesMajorFacts();
        // $processesMajorFacts = $this->processesMajorFacts();
        // $controlPointsMajorFacts = $this->controlPointsMajorFacts();
        return compact(
            'missionsMajorFacts',
            'campaignsMajorFacts',
            'familiesMajorFacts',
            'dresMajorFacts',
            'domainsMajorFacts',
            'agenciesMajorFacts',
            // 'processesMajorFacts',
            // 'controlPointsMajorFacts',
        );
    }
    public function regularizations()
    {
        $scores = $this->scores();
        $missionsAnomalies = $this->missionsAnomalies();
        $campaignsAnomalies = $this->campaignsAnomalies();
        $familiesAnomalies = $this->familiesAnomalies();
        $domainsAnomalies = $this->domainsAnomalies();
        $processesAnomalies = $this->processesAnomalies();
        $controlPointsAnomalies = $this->controlPointsAnomalies();
        $dresAnomalies = $this->dresAnomalies();
        $agenciesAnomalies = $this->agenciesAnomalies();
        $missionsMajorFacts = $this->missionsMajorFacts();
        $campaignsMajorFacts = $this->campaignsMajorFacts();
        $familiesMajorFacts = $this->familiesMajorFacts();
        $domainsMajorFacts = $this->domainsMajorFacts();
        $processesMajorFacts = $this->processesMajorFacts();
        $controlPointsMajorFacts = $this->controlPointsMajorFacts();
        $dresMajorFacts = $this->dresMajorFacts();
        $agenciesMajorFacts = $this->agenciesMajorFacts();
        $missionsPercentage = $this->missionsPercentage();
        $dresClassificationByAchievementRate = $this->dresClassificationByAchievementRate();
        $avgScoreByDre = $this->avgScoreByDre();
        $avgScoreByFamily = $this->avgScoreByFamily();
        $avgScoreByDomain = $this->avgScoreByDomain();
        $missionsState = $this->missionsState();
        return compact('');
    }
    public function scores()
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
        $missions = hasRole(['dcp', 'cdcr']) ? Mission::all() : $this->getMissions()->get();
        $active = (clone $missions)->filter(fn ($mission) => $mission->realisation_state == 'En cours')->count();
        $todo = (clone $missions)->filter(fn ($mission) => $mission->realisation_state == 'À réaliser')->count();
        $delay = (clone $missions)->filter(fn ($mission) => $mission->realisation_state == 'En retard')->count();
        $done = (clone $missions)->filter(fn ($mission) => $mission->realisation_state == 'Réaliser' || $mission->realisation_state == 'Validé et envoyé' || $mission->realisation_state == '2ème validation' || $mission->realisation_state == '1ère validation')->count();
        return compact('delay', 'active', 'todo', 'done');
    }

    /**
     * Fetch scores statistics
     *
     * @return array
     */
    private function globalScores(): array
    {
        $details = $this->getDetails()->whereNotNull('score')->groupBy('score')->selectRaw('score, COUNT(*) as scores_count')->get()->pluck('scores_count', 'score');
        $labels = $details->keys();
        extract($this->defaultColors());
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
        // $dres = Dre::with(['details' => fn ($details) => $details])
        //     ->withAvg('details', 'score')
        //     ->get()
        //     ->pluck('details_avg_score', 'full_name');
        $dres = $this->getDetails()->with('dre')->get()->groupBy('dre.name');
        $scores = [];
        foreach ($dres as $dre => $details) {
            array_push($scores, ['dre' => $dre, 'avg_score' => intval(round(floatval($details->avg('score'))))]);
        }
        uasort($scores, function ($a, $b) {
            return $a['avg_score'] - $b['avg_score'];
        });
        return array_values($scores);
    }

    /**
     * Get avg scores for each agency
     *
     * @return array
     */
    private function avgScoreByAgency(): array
    {
        // $agencies = $agencies->with(['details' => fn ($details) => $details, 'dre'])
        //     ->withAvg('details', 'score')
        //     ->get();
        $agencies = request()->has('dre_id') ? Agency::where('dre_id', request()->dre_id) : $this->getDetails()->with('agency')->get()->groupBy('agency.name');
        $scores = [];
        foreach ($agencies as $agency => $details) {
            array_push($scores, ['dre' => $details->first()->dre->full_name, 'agency' => $agency, 'avg_score' => intval(round(floatval($details->avg('score'))))]);
        }
        uasort($scores, function ($a, $b) {
            return $a['avg_score'] - $b['avg_score'];
        });
        return array_values($scores);
    }

    /**
     * Get avg scores for each family
     *
     * @return array
     */
    private function avgScoreByFamily(): array
    {
        $families = $this->getDetails()->with('familly')->get()->groupBy('familly.name')
            ->mapWithKeys(fn ($details, $family) => [$family => intval(round(floatval($details->avg('score'))))]);
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
        $domains = $this->getDetails()->with('domain')->get()->groupBy('domain.name')
            ->map(fn ($details, $domain) =>  ['domain' => $domain, 'avg_score' => intval(round(floatval($details->avg('score'))))])->toArray();
        uasort($domains, function ($a, $b) {
            return $a['avg_score'] - $b['avg_score'];
        });
        return array_values($domains);
    }


    /**
     * Fetch dres classification by achievement rate
     *
     * @return array
     */
    private function dresClassificationByAchievementRate(): array
    {
        // $dres = Dre::with('missions')->whereHas('missions')->get();
        $missions = $this->getMissions()->with('dre')->get()->groupBy('dre.name');
        $achievments = [];
        foreach ($missions as $dre => $missions) {
            $dre = $missions->first()->dre;
            $totalAchieved = $dre->missions()->validated()->count();
            $total = $dre->missions()->count();
            $rate = $total ? number_format(($totalAchieved * 100) / $total, 2) : 0;
            array_push($achievments, ['dre' => $dre->full_name, 'total' => $total, 'totalAchieved' => $totalAchieved, 'rate' => $rate]);
        }
        // foreach ($dres as $dre) {
        //     $totalAchieved = $dre->missions()->validated()->count();
        //     $total = $dre->missions()->count();
        //     $rate = $total ? number_format(($totalAchieved * 100) / $total, 2) : 0;
        //     array_push($achievments, ['dre' => $dre->full_name, 'total' => $total, 'totalAchieved' => $totalAchieved, 'rate' => $rate]);
        // }
        // usort($achievments, function ($a, $b) {
        //     return $b['rate'] - $a['rate'];
        // });

        return $achievments;
    }

    /**
     * Fetch missions validations statistics
     *
     * @return array
     */
    private function missionsPercentage(): array
    {
        $missions = hasRole(['dcp', 'cdcr']) ? new Mission : $this->getMissions();
        $total = $missions->executed()->count();
        $validated = $missions->validated()->count();
        $notValidated = ($total - $validated);

        $labels = ['Rapports validés', 'Rapports non validés'];
        extract($this->defaultColors());
        $datasets = [
            [
                "label" => "Anomalies par mission",
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
        $missions = $this->getMissions()->withCount(['details' => fn ($query) => $query->whereAnomaly()])->get()->map(fn ($mission) => ['mission' => $mission->reference, 'total_anomaly' => $mission->details_count])->sortByDesc('total_anomaly')->take(10)->toArray();
        return array_values($missions);
    }
    /**
     * Fetch campaigns anomalies statistics
     *
     * @return array
     */
    private function campaignsAnomalies(): array
    {
        $campaigns = $this->getCampaigns()->withCount(['details' => fn ($query) => $query->whereAnomaly()])->get()->map(fn ($campaign) => ['campaign' => $campaign->reference, 'total_anomaly' => $campaign->details_count])->sortByDesc('total_anomaly')->take(10)->toArray();
        return array_values($campaigns);
    }

    /**
     * Fetch famillies anomalies statistics
     *
     * @return array
     */
    private function familiesAnomalies(): array
    {
        $anomalies = $this->getDetails()->whereAnomaly()->with('familly')->get()->groupBy('familly.id')->mapWithKeys(function ($data, $key) {
            $familyName = $data->first()->familly->name;
            return [$familyName => $data->count()];
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
        $domains = $this->getDetails()->whereAnomaly()->with('domain')->get()->groupBy('domain.name')
            ->map(fn ($details, $domain) => ['domain' => $domain, 'total' => $details->count()])->sortByDesc('total_major_facts')->toArray();
        return array_values($domains);
    }

    /**
     * Fetch processes anomalies statistics
     *
     * @return array
     */
    private function processesAnomalies(): array
    {
        $anomalies = $this->getDetails()
            ->with('process')
            ->get()
            ->groupBy('process.id')
            ->mapWithKeys(function ($data, $key) {
                $processName = $data->first()->process->name;
                return [$processName => $data->count()];
            });
        $labels = $anomalies->keys();
        extract($this->defaultColors());
        $datasets = [
            [
                "label" => "Anomalies par processus",
                "data" => $anomalies->values(),
                'backgroundColor' => $backgroundColor,
                'borderColor' => $borderColor,
                'borderWidth' => $borderWidth,
            ]
        ];
        return compact('labels', 'datasets');
    }

    /**
     * Fetch control points anomalies statistics
     *
     * @return array
     */
    private function controlPointsAnomalies(): array
    {
        $anomalies = $this->getDetails()
            ->with('controlPoint')
            ->get()
            ->groupBy('control_point_id')
            ->mapWithKeys(function ($data, $key) {
                $controlPoint = $data->first()->controlPoint->name;
                return [$controlPoint => $data->count()];
            });
        $labels = $anomalies->keys();
        extract($this->defaultColors());
        $datasets = [
            [
                "label" => "Anomalies par point de contrôle",
                "data" => $anomalies->values(),
                'backgroundColor' => $backgroundColor,
                'borderColor' => $borderColor,
                'borderWidth' => $borderWidth,
            ]
        ];
        return compact('labels', 'datasets');
    }

    /**
     * Fetch dres anomalies statistics
     *
     * @return array
     */
    private function dresAnomalies(): array
    {
        $anomalies = $this->getDetails()
            ->with('dre')
            ->get()
            ->groupBy('dre.id')
            ->mapWithKeys(function ($data, $key) {
                $dre = $data->first()->dre->name;
                return [$dre => $data->count()];
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
            ->whereAnomaly()
            ->with('agency')
            ->get()
            ->groupBy('agency.id')
            ->map(fn ($details) => ['agency' => $details->first()->agency->full_name, 'total_anomalies' => $details->count()])->sortByDesc('total_anomalies')->toArray();
        return array_values($anomalies);
    }

    /**
     * Fetch mission major facts statistics
     *
     * @return array
     */
    private function missionsMajorFacts(): array
    {
        $missions = $this->getMissions()->withCount(['details' => fn ($query) => $query->onlyMajorFacts()])->get()->map(fn ($mission) => ['mission' => $mission->reference, 'total_major_facts' => $mission->details_count])->sortByDesc('total_major_facts')->take(10)->toArray();
        return array_values($missions);
    }
    /**
     * Fetch campaigns major facts statistics
     *
     * @return array
     */
    private function campaignsMajorFacts(): array
    {
        $campaigns = $this->getCampaigns()->withCount(['details' => fn ($query) => $query->onlyMajorFacts()])->get()->map(fn ($campaign) => ['campaign' => $campaign->reference, 'total_major_facts' => $campaign->details_count])->sortByDesc('total_major_facts')->take(10)->toArray();
        return array_values($campaigns);
    }

    /**
     * Fetch famillies major facts statistics
     *
     * @return array
     */
    private function familiesMajorFacts(): array
    {
        $majorFacts = $this->getDetails()->onlyMajorFacts()->with('familly')->get()->groupBy('familly.id')->mapWithKeys(function ($data, $key) {
            $famillyName = $data->first()->familly->name;
            return [$famillyName => $data->count()];
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
        $domains = $this->getDetails()->onlyMajorFacts()->with('domain')->get()->groupBy('domain.name')
            ->map(fn ($details, $domain) => ['domain' => $domain, 'total' => $details->count()])->sortByDesc('total_major_facts')->toArray();
        return array_values($domains);
    }

    /**
     * Fetch processes major facts statistics
     *
     * @return array
     */
    private function processesMajorFacts(): array
    {
        $majorFacts = $this->getDetails()
            ->onlyMajorFacts()
            ->with('process')
            ->get()
            ->groupBy('process.id')
            ->mapWithKeys(function ($data, $key) {
                $processName = $data->first()->process->name;
                return [$processName => $data->count()];
            });
        $labels = $majorFacts->keys();
        extract($this->defaultColors());
        $datasets = [
            [
                "label" => "Faits majeur par processus",
                "data" => $majorFacts->values(),
                'backgroundColor' => $backgroundColor,
                'borderColor' => $borderColor,
                'borderWidth' => $borderWidth,
            ]
        ];
        return compact('labels', 'datasets');
    }

    /**
     * Fetch control points major facts statistics
     *
     * @return array
     */
    private function controlPointsMajorFacts(): array
    {
        $majorFacts = $this->getDetails()
            ->onlyMajorFacts()
            ->with('controlPoint')
            ->get()
            ->groupBy('control_point_id')
            ->mapWithKeys(function ($data, $key) {
                $controlPoint = $data->first()->controlPoint->name;
                return [$controlPoint => $data->count()];
            });
        $labels = $majorFacts->keys();
        extract($this->defaultColors());
        $datasets = [
            [
                "label" => "Faits majeur par points de contrôle",
                "data" => $majorFacts->values(),
                'backgroundColor' => $backgroundColor,
                'borderColor' => $borderColor,
                'borderWidth' => $borderWidth,
            ]
        ];
        return compact('labels', 'datasets');
    }

    /**
     * Fetch dres major facts statistics
     *
     * @return array
     */
    private function dresMajorFacts(): array
    {
        $majorFacts = $this->getDetails()
            ->onlyMajorFacts()
            ->with('dre')
            ->get()
            ->groupBy('dre.id')
            ->mapWithKeys(function ($data, $key) {
                $dre = $data->first()->dre->name;
                return [$dre => $data->count()];
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
            ->onlyMajorFacts()
            ->with('agency')
            ->get()
            ->groupBy('agency.id')
            ->map(fn ($details) => ['agency' => $details->first()->agency->full_name, 'total_major_facts' => $details->count()])->sortByDesc('total_major_facts')->take(10)->toArray();
        return array_values($majorFacts);
    }

    /**
     * Filter Campaigns data
     *
     * @return Builder
     */
    private function getCampaigns()
    {
        $campaigns = new ControlCampaign;
        $campaigns = hasRole(['ci', 'cc']) ? auth()->user()->campaigns() : $campaigns->validated();
        return $campaigns->select('reference');
    }

    /**
     * Filter Mission Details data
     *
     * @return Builder
     */
    private function getDetails()
    {
        $user = auth()->user();
        $details = MissionDetail::whereNotNull('score');
        if (hasRole('dcp')) {
            $details = $details->hasCdcrValidation();
        } elseif (hasRole('cdcr')) {
            $details = $details->dreReportValidated();
        } elseif (hasRole(['cdc', 'cc', 'ci'])) {
            $details = $user->details();
        } elseif (hasRole(['dg', 'cdrcp', 'der'])) {
            $details = $details->hasDcpValidation();
        } elseif (hasRole('dre')) {
            $details = auth()->user()->details()->hasDcpValidation();
        } elseif (hasRole('da')) {
            $details = $user->details()->hasDcpValidation();
        }
        return $details->without(['process', 'domain', 'controlPoint', 'familly', 'media']);
    }

    /**
     * Filter Missions
     *
     * @return Builder
     */
    private function getMissions()
    {
        $missions = new Mission;
        $user = auth()->user();
        if (hasRole(['dcp', 'cdcr'])) {
            $missions = $missions->validated();
        } elseif (hasRole(['cdc', 'cc', 'ci'])) {
            $missions = $user->missions();
        } elseif (hasRole(['da', 'dre'])) {
            $missions = $user->missions()->hasDcpValidation();
        } elseif (hasRole(['dg', 'cdrcp', 'der'])) {
            $missions = $missions->hasDcpValidation();
        }
        return $missions;
    }

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
