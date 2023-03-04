<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ControlCampaign;
use App\Models\Mission;
use App\Models\MissionDetail;
use Illuminate\Database\Eloquent\Builder;
use Throwable;

class DataController extends Controller
{
    public function dashboard()
    {
        $scores = $this->scores();
        $missionsAnomalies = $this->missionsAnomalies();
        $campaignsAnomalies = $this->campaignsAnomalies();
        $familliesAnomalies = $this->familliesAnomalies();
        $domainsAnomalies = $this->domainsAnomalies();
        $processesAnomalies = $this->processesAnomalies();
        $controlPointsAnomalies = $this->controlPointsAnomalies();
        $dresAnomalies = $this->dresAnomalies();
        $agenciesAnomalies = $this->agenciesAnomalies();
        $missionsMajorFacts = $this->missionsMajorFacts();
        $campaignsMajorFacts = $this->campaignsMajorFacts();
        $familliesMajorFacts = $this->familliesMajorFacts();
        $domainsMajorFacts = $this->domainsMajorFacts();
        $processesMajorFacts = $this->processesMajorFacts();
        $controlPointsMajorFacts = $this->controlPointsMajorFacts();
        $dresMajorFacts = $this->dresMajorFacts();
        $agenciesMajorFacts = $this->agenciesMajorFacts();
        extract($this->defaultColors());
        $chartOptions = [
            'backgroundColor' => $backgroundColor,
            'borderColor' => $borderColor,
            'borderWidth' => $borderWidth,
        ];
        return compact(
            'chartOptions',
            'scores',
            'missionsAnomalies',
            'campaignsAnomalies',
            'familliesAnomalies',
            'domainsAnomalies',
            'processesAnomalies',
            'controlPointsAnomalies',
            'dresAnomalies',
            'agenciesAnomalies',
            'missionsMajorFacts',
            'campaignsMajorFacts',
            'familliesMajorFacts',
            'domainsMajorFacts',
            'processesMajorFacts',
            'controlPointsMajorFacts',
            'dresMajorFacts',
            'agenciesMajorFacts',
        );
        // return $data;
        // dd($data);
    }
    /**
     * Fetch mission anomalies statistics
     *
     * @return array
     */
    private function missionsAnomalies(): array
    {
        $missions = $this->getMissions()->withCount(['details' => fn ($query) => $query->whereAnomaly()])->get()->pluck('details_count', 'reference');
        $labels = $missions->keys();
        $datasets = [
            [
                "label" => "Anomalies par mission",
                "data" => $missions->values(),
            ]
        ];
        return compact('labels', 'datasets');
    }
    /**
     * Fetch campaigns anomalies statistics
     *
     * @return array
     */
    private function campaignsAnomalies(): array
    {
        $campaigns = $this->getCampaigns()->withCount(['details' => fn ($query) => $query->whereAnomaly()])->get()->pluck('details_count', 'reference');
        $labels = $campaigns->keys();
        $datasets = [
            [
                "label" => "Anomalies par campagne de contrôle",
                "data" => $campaigns->values(),
            ]
        ];
        return compact('labels', 'datasets');
    }

    /**
     * Fetch scores statistics
     *
     * @return array
     */
    private function scores(): array
    {
        $details = $this->getDetails()->whereNotNull('score')->groupBy('score')->selectRaw('score, COUNT(*) as scores_count')->get()->pluck('scores_count', 'score');
        $labels = $details->keys();
        $datasets = [
            [
                "label" => "Anomalies par mission",
                "data" => $details->values(),
            ]
        ];
        return compact('labels', 'datasets');
    }

    /**
     * Fetch famillies anomalies statistics
     *
     * @return array
     */
    private function familliesAnomalies(): array
    {
        $anomalies = $this->getDetails()->onlyMajorFacts()->with('familly')->get()->groupBy('familly.id')->mapWithKeys(function ($data, $key) {
            $famillyName = $data->first()->familly->name;
            return [$famillyName => $data->count()];
        });
        $labels = $anomalies->keys();
        $datasets = [
            [
                "label" => "Anomalies par familles",
                "data" => $anomalies->values(),
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
        $anomalies = $this->getDetails()->onlyMajorFacts()->with('domain')->get()->groupBy('domain.name')->map(fn ($details) => $details->count());
        $labels = $anomalies->keys();
        $datasets = [
            [
                "label" => "Anomalies par domaine",
                "data" => $anomalies->values(),
            ]
        ];
        return compact('labels', 'datasets');
    }

    /**
     * Fetch processes anomalies statistics
     *
     * @return array
     */
    private function processesAnomalies(): array
    {
        $anomalies = $this->getDetails()
            ->onlyMajorFacts()
            ->with('process')
            ->get()
            ->groupBy('process.id')
            ->mapWithKeys(function ($data, $key) {
                $processName = $data->first()->process->name;
                return [$processName => $data->count()];
            });
        $labels = $anomalies->keys();
        $datasets = [
            [
                "label" => "Anomalies par processus",
                "data" => $anomalies->values(),
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
            ->onlyMajorFacts()
            ->with('controlPoint')
            ->get()
            ->groupBy('control_point_id')
            ->mapWithKeys(function ($data, $key) {
                $controlPoint = $data->first()->controlPoint->name;
                return [$controlPoint => $data->count()];
            });
        $labels = $anomalies->keys();
        $datasets = [
            [
                "label" => "Anomalies par point de contrôle",
                "data" => $anomalies->values(),
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
            ->onlyMajorFacts()
            ->with('dre')
            ->get()
            ->groupBy('dre.id')
            ->mapWithKeys(function ($data, $key) {
                $dre = $data->first()->dre->name;
                return [$dre => $data->count()];
            });
        $labels = $anomalies->keys();
        $datasets = [
            [
                "label" => "Anomalies par DRE",
                "data" => $anomalies->values(),
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
            ->onlyMajorFacts()
            ->with('agency')
            ->get()
            ->groupBy('agency.id')
            ->mapWithKeys(function ($data, $key) {
                $agency = $data->first()->agency->name;
                return [$agency => $data->count()];
            });
        $labels = $anomalies->keys();
        $datasets = [
            [
                "label" => "Anomalies par agence",
                "data" => $anomalies->values(),
            ]
        ];
        return compact('labels', 'datasets');
    }

    /**
     * Fetch mission major facts statistics
     *
     * @return array
     */
    private function missionsMajorFacts(): array
    {
        $missions = $this->getMissions()->withCount(['details' => fn ($query) => $query->whereAnomaly()])->get()->pluck('details_count', 'reference');
        $labels = $missions->keys();
        $datasets = [
            [
                "label" => "Faits majeur par mission",
                "data" => $missions->values(),
            ]
        ];
        return compact('labels', 'datasets');
    }
    /**
     * Fetch campaigns major facts statistics
     *
     * @return array
     */
    private function campaignsMajorFacts(): array
    {
        $campaigns = $this->getCampaigns()->withCount(['details' => fn ($query) => $query->whereAnomaly()])->get()->pluck('details_count', 'reference');
        $labels = $campaigns->keys();
        $datasets = [
            [
                "label" => "Faits majeur campagne de contrôle",
                "data" => $campaigns->values(),
            ]
        ];
        return compact('labels', 'datasets');
    }

    /**
     * Fetch famillies major facts statistics
     *
     * @return array
     */
    private function familliesMajorFacts(): array
    {
        $majorFacts = $this->getDetails()->onlyMajorFacts()->with('familly')->get()->groupBy('familly.id')->mapWithKeys(function ($data, $key) {
            $famillyName = $data->first()->familly->name;
            return [$famillyName => $data->count()];
        });
        $labels = $majorFacts->keys();
        $datasets = [
            [
                "label" => "Faits majeur par familles",
                "data" => $majorFacts->values(),
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
        $majorFacts = $this->getDetails()->onlyMajorFacts()->with('domain')->get()->groupBy('domain.name')->map(fn ($details) => $details->count());
        $labels = $majorFacts->keys();
        $datasets = [
            [
                "label" => "Faits majeur par domaine",
                "data" => $majorFacts->values(),
            ]
        ];
        return compact('labels', 'datasets');
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
        $datasets = [
            [
                "label" => "Faits majeur par processus",
                "data" => $majorFacts->values(),
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
        $datasets = [
            [
                "label" => "Faits majeur par points de contrôle",
                "data" => $majorFacts->values(),
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
        $datasets = [
            [
                "label" => "Faits majeur par DRE",
                "data" => $majorFacts->values(),
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
            ->mapWithKeys(function ($data, $key) {
                $agency = $data->first()->agency->name;
                return [$agency => $data->count()];
            });
        $labels = $majorFacts->keys();
        $datasets = [
            [
                "label" => "Faits majeur par Agence",
                "data" => $majorFacts->values(),
            ]
        ];
        return compact('labels', 'datasets');
    }

    /**
     * Filter Campaigns data
     *
     * @return Builder
     */
    private function getCampaigns()
    {
        $campaigns = new ControlCampaign;
        return hasRole(['ci', 'cc']) ? auth()->user()->campaigns() : $campaigns->validated();
    }

    /**
     * Filter Mission Details data
     *
     * @return Builder
     */
    private function getDetails()
    {
        $user = auth()->user();
        $details = new MissionDetail;
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
        return $details;
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

    public function missions_state()
    {
        // dd(hasRole('root'));
        $missions = Mission::all();
        $active = (clone $missions)->filter(fn ($planning) => $planning->realisation_state == 'EN COURS')->count();
        $todo = (clone $missions)->filter(fn ($planning) => $planning->realisation_state == 'À RÉALISER')->count();
        $delay = (clone $missions)->filter(fn ($planning) => $planning->realisation_state == 'EN RETARD')->count();
        $done = (clone $missions)->filter(fn ($planning) => $planning->realisation_state == 'RÉALISÉ' || $planning->realisation_state == 'Validé et envoyé')->count();

        return hasRole('root') ? [] : response()->json(compact('delay', 'active', 'todo', 'done'));
    }

    public function missions_percentage()
    {
        $total = Mission::where('validated_at', '!=', null)->count();
        $validated = Mission::validated()->count() * 100;
        $notValidated = Mission::notValidated()->count() * 100;
        try {
            $validated = number_format($validated / $total, 2);
            $notValidated = number_format($notValidated / $total, 2);
        } catch (Throwable $th) {
        }


        return hasRole('root') ? [] : compact('notValidated', 'validated');
    }

    public function defaultColors(): array
    {
        return [
            'backgroundColor' => [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            'borderColor' => [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            'borderWidth' => 1
        ];
    }
}
