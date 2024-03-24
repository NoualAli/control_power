<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Statistics\Anomalies;
use App\Statistics\MajorFacts;
use App\Statistics\Missions;
use App\Statistics\Scores;

class StatisticController extends Controller
{
    /**
     * Missions data section
     */
    public function missionsStates()
    {
        $statistics = new Missions;
        $dresClassificationByAchievementRate = [];
        $missionsPercentage = hasRole(['ci', 'da']) ? [] : $statistics->percentage();
        $missionsState = hasRole('da') ? [] : $statistics->state();
        $currentCampaign = $statistics->current_campaign;
        if (hasRole(['dg', 'dga', 'sg', 'ig', 'iga', 'deac', 'cdrcp', 'dcp', 'cdcr', 'cc', 'root', 'admin'])) {
            $dresClassificationByAchievementRate = $statistics->achievementRate();
        }
        return compact(
            'dresClassificationByAchievementRate',
            'missionsPercentage',
            'missionsState',
            'currentCampaign'
        );
    }

    /**
     * Scores data section
     *
     * @return array
     */
    public function scores(): array
    {
        $statistics = new Scores;
        $avgScoreByDre = $statistics->avgByDre();
        $avgScoreByFamily = $statistics->avgByFamily();
        $avgScoreByDomain = $statistics->avgByDomain();
        $globalScores = $statistics->global();
        $currentCampaign = $statistics->current_campaign;
        return compact(
            'avgScoreByDre',
            'avgScoreByFamily',
            'avgScoreByDomain',
            'globalScores',
            'currentCampaign'
        );
    }

    /**
     * Anomalies section
     *
     * @return array
     */
    public function anomalies(): array
    {
        $statistics = new Anomalies;
        $missionsAnomalies = $statistics->missions();
        $campaignsAnomalies = $statistics->campaigns();
        $familiesAnomalies = $statistics->families();
        $domainsAnomalies = $statistics->domains();
        $dresAnomalies = $statistics->dres();
        $agenciesAnomalies = $statistics->agencies();
        $currentCampaign = $statistics->current_campaign;
        return compact(
            'missionsAnomalies',
            'campaignsAnomalies',
            'familiesAnomalies',
            'domainsAnomalies',
            'dresAnomalies',
            'agenciesAnomalies',
            'currentCampaign'
        );
    }

    /**
     * Major Facts data section
     *
     * @return array
     */
    public function majorFacts(): array
    {
        if (!hasRole('da')) {
            $statistics = new MajorFacts;
            $missionsMajorFacts = $statistics->missions();
            $campaignsMajorFacts = $statistics->campaigns();
            $familiesMajorFacts = $statistics->families();
            $domainsMajorFacts = $statistics->domains();
            $dresMajorFacts = $statistics->dres();
            $agenciesMajorFacts = $statistics->agencies();
            $currentCampaign = $statistics->current_campaign;
            return compact(
                'missionsMajorFacts',
                'campaignsMajorFacts',
                'familiesMajorFacts',
                'dresMajorFacts',
                'domainsMajorFacts',
                'agenciesMajorFacts',
                'currentCampaign',
            );
        } else {
            abort(FORBIDDEN);
        }
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
}
