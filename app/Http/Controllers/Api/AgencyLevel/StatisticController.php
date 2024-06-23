<?php

namespace App\Http\Controllers\Api\AgencyLevel;

use App\Http\Controllers\Controller;
use App\Statistics\AgencyLevel\Anomalies;
use App\Statistics\AgencyLevel\CurrentCampaign;
use App\Statistics\AgencyLevel\MajorFacts;
use App\Statistics\AgencyLevel\Missions;
use App\Statistics\AgencyLevel\Scores;
use App\Statistics\AgencyLevel\StatisticsData;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function currentCampaign()
    {

        $currentCampaign = (new StatisticsData)->current_campaign;
        if ($currentCampaign) {
            $currentCampaign->start_date = Carbon::parse($currentCampaign->start_date)->format('d-m-Y');
            $currentCampaign->end_date = Carbon::parse($currentCampaign->end_date)->format('d-m-Y');
            unset(
                $currentCampaign->creator_full_name,
                $currentCampaign->validator_full_name,
                $currentCampaign->is_for_testing,
                $currentCampaign->created_by_id,
                $currentCampaign->validated_by_id,
                $currentCampaign->updated_at,
                $currentCampaign->created_at,
                $currentCampaign->description,
                $currentCampaign->validated_at,
            );
            return response()->json($currentCampaign);
        }

        return response()->json($currentCampaign);
    }

    /**
     * Missions data section
     */
    public function missionsStates()
    {
        try {
            $statistics = new Missions;
            $dresClassificationByAchievementRate = [];
            $totalAnomalies = 0;
            $totalProgrammed = 0;
            $totalAchieved = 0;
            $missionsPercentage = hasRole(['ci', 'da']) ? [] : $statistics->percentage();
            $missionsState = hasRole('da') ? [] : $statistics->state();
            if (hasRole(['dg', 'dga', 'sg', 'ig', 'iga', 'deac', 'cdrcp', 'dcp', 'cdcr', 'cc', 'root', 'admin'])) {
                $dresClassificationByAchievementRate = $statistics->achievementRate();
                $totalAnomalies = $this->totalAnomalies($statistics);
                $totalProgrammed = $this->totalProgrammed($statistics);
                $totalAchieved = $this->totalAchieved($statistics);
            }
            return compact(
                'dresClassificationByAchievementRate',
                'missionsPercentage',
                'missionsState',
                'totalProgrammed',
                'totalAchieved',
                'totalAnomalies',
            );
        } catch (\Throwable $th) {
            return throwedError($th);
        }
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
     * TODO
     * Regularizations data section
     *
     * @return array
     */
    public function regularizations(): array
    {
        // TODO
        return [];
    }

    public function dre(string $campaign, string $dre)
    {
        $dre = explode(' - ', $dre);
        $dreCode = array_key_exists(0, $dre) ? $dre[0] : null;

        abort_if(!$dreCode, 422, "Le code DRE n'existe pas");


        $missionsStates = DB::table('mission_details AS md')
            ->leftJoin('missions AS m', 'm.id', 'md.mission_id')
            ->leftJoin('agencies AS a', 'a.id', 'm.agency_id')
            ->leftJoin('dres AS d', 'd.id', 'a.dre_id')
            ->leftJoin('control_campaigns AS cc', 'cc.id', 'm.control_campaign_id')
            ->select([
                'm.reference AS reference',
                'm.id AS m_id',
                DB::raw("CONCAT(a.code, ' - ', a.name) AS agency"),
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
            ->where('cc.id', $campaign)
            ->where('d.code', $dreCode)
            ->groupBy('m.reference', 'm.id', 'a.code', 'a.name')
            ->get();
        return response()->json(compact('missionsStates'));
    }

    private function totalProgrammed($statistics)
    {
        $data = $statistics->achievementRate();
        $totalProgrammed = 0;
        foreach ($data as $item) {
            $totalProgrammed += $item['total'];
        }
        return $totalProgrammed;
    }

    private function totalAchieved($statistics)
    {
        $data = $statistics->achievementRate();
        $totalAchieved = 0;
        foreach ($data as $item) {
            $totalAchieved += $item['totalAchieved'];
        }
        return $totalAchieved;
    }

    private function totalAnomalies($statistics)
    {
        $data = $statistics->achievementRate();
        $totalAnomalies = 0;
        foreach ($data as $item) {
            $totalAnomalies += $item['anomalies_count'];
        }
        return $totalAnomalies;
    }
}
