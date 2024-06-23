<?php

namespace App\Http\Controllers\Api\AgencyLevel\Statistics;

use App\Exports\KPI\AccomplishRateExport;
use App\Exports\KPI\MissionsFallExport;
use App\Exports\KPI\TimeLagExport;
use App\Http\Controllers\Controller;
use App\Statistics\AgencyLevel\KPI;
use Maatwebsite\Excel\Facades\Excel;

class KPIController extends Controller
{
    protected $kpi;

    public function __construct()
    {
        $this->kpi = new KPI;
    }

    public function v1()
    {
        if (hasRole(['dcp', 'cdcr', 'root', 'admin'])) {
            $accomplishRate = $this->kpi->accomplishRate();
            $timeLag = $this->kpi->timeLag();
            $missionsFall = $this->kpi->missionsFall();

            return compact('accomplishRate', 'timeLag', 'missionsFall');
        }

        abort(FORBIDDEN, "Vous n'êtes pas autoriser à accéder à cette ressource");
    }

    public function exportToExcel(string $type)
    {
        if ($type == 'accomplishRate') {
            return Excel::download(new AccomplishRateExport($this->kpi->accomplishRate()), 'accomplish_rate.xlsx');
        } elseif ($type == 'timeLag') {
            return Excel::download(new TimeLagExport($this->kpi->timeLag()), 'time_lag.xlsx');
        } elseif ($type == 'missionsFall') {
            return Excel::download(new MissionsFallExport($this->kpi->missionsFall()), 'missions_fall.xlsx');
        }
    }
}
