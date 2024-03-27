<?php

namespace App\Http\Controllers\Api\AgencyLevel\Mission;

use App\Exports\MissionDetailExport;
use App\Http\Controllers\Controller;
use App\Http\Resources\AnomalyResource;
use App\Services\ExcelExportService;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class AnomalyController extends Controller
{
    /**
     * @return Illuminate\Http\JsonResponse
     */
    public function index()
    {
        isAbleOrAbort(['view_mission_detail']);
        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);

        $details = getMissionAnomalies();
        $export = request('export', []);
        $shouldExport = count($export) || request()->has('export');
        try {
            if ($fetchFilters) {
                return $this->filters($details);
            }
            if (request()->has('campaign_id')) {
                $details = $details->where('control_campaign_id', request()->campaign_id);
            }

            if ($shouldExport) {
                $mission = getMissions(request('mission'), 2);
                $missionReference = $mission->reference ? '-' . str_replace('/', '-', $mission->reference) . '-' : null;
                $filename = 'détails_de_mission-' . $mission->campaign . $missionReference . Str::slug($mission->dre . '-' . $mission->agency) . '.xlsx';
                $details = getMissionDetails($mission->id);
                return (new ExcelExportService($details, MissionDetailExport::class, $filename, $export))->download();
            }
            if ($sort) {
                $details = $details->sortByMultiple($sort);
            } else {
                $details = $details->orderBy('md.created_at', 'DESC');
            }

            if ($search) {
                $details = $details->search(['cp.name', 'md.reference'], $search);
            }

            if ($filter) {
                $details = $this->filter($details, $filter);
            }

            $details = AnomalyResource::collection($details->paginate($perPage)->onEachSide(1));
            return $details;
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    /**
     * Get details filters data
     *
     * @param Builder $details
     *
     * @return array
     */
    public function filters(Builder $details): array
    {
        $user = auth()->user();
        $details = $details->get();

        $families = (clone $details)->groupBy('family')->keys();
        $family = getFamilies()->whereIn('name', $families)->get()->map(fn ($item) => ['id' => $item->id, 'label' => $item->name])->toArray();
        $domain = [];
        $process = [];
        // $dre = hasRole(['cdc', 'ci', 'dre', 'da']) ? [$user->dre] : [];
        $dre = [];
        $agency = [];
        // $campaign = formatForSelect(getControlCampaigns()->get()->map(fn ($item) => ['id' => $item->id, 'reference' => $item->reference])->toArray(), 'reference');
        $campaign = getControlCampaigns()
            ->whereNotNull('m.reference')
            ->orderBy('c.reference', 'DESC')
            ->get()
            ->unique()
            ->map(fn ($item) => ['id' => $item->id, 'reference' => $item->reference])
            ->toArray();
        $campaign = formatForSelect($campaign, 'reference');
        $mission = [];
        if (isset(request()->filter['campaign'])) {
            $agency = hasRole(['cdc', 'ci', 'dre', 'da']) ? formatForSelect($user->agencies->toArray(), 'full_name') : [];
            $campaigns = explode(',', request()->filter['campaign']);
            $filterDre = isset(request()->filter['dre']) ? request()->filter['dre'] : '';
            if (hasRole(['cdc', 'ci', 'da'])) {
                $filterDre = auth()->user()->dres->pluck('id')->join(',');
            }
            $dre = getDre()
                ->join('agencies as a', 'd.id', 'a.dre_id')
                ->join('missions as m', 'm.agency_id', 'a.id')
                ->join('mission_details as md', 'md.mission_id', 'm.id')
                ->whereIn('md.score', [2, 3, 4])
                ->whereIn('m.control_campaign_id', $campaigns)
                ->get()
                ->map(fn ($item) => ['id' => $item->id, 'full_name' => $item->full_name])->toArray();
            $dre = formatForSelect($dre, 'full_name');

            if (!empty($filterDre)) {
                $dres = explode(',', $filterDre);
                $agency = getAgencies()
                    ->join('missions as m', 'm.agency_id', 'a.id')
                    ->join('mission_details as md', 'md.mission_id', 'm.id');
                if (hasRole('ci')) {
                    $agency = $agency->where('m.assigned_to_ci_id', auth()->user()->id);
                } elseif (hasRole('cdc')) {
                    $agency = $agency;
                } else {
                    $agency = $agency->whereIn('dre_id', $dres);
                }

                $agency = $agency->whereIn('md.score', [2, 3, 4])->get()
                    ->map(fn ($item) => ['id' => $item->id, 'full_name' => $item->full_name])->toArray();
                $agency = formatForSelect($agency, 'full_name');

                if (isset(request()->filter['agency'])) {
                    $agencies = explode(',', request()->filter['agency']);
                    $mission = getMissions()
                        ->whereIn('md.score', [2, 3, 4])
                        ->whereIn('control_campaign_id', $campaigns)
                        ->whereIn('agency_id', $agencies)
                        ->get()->map(fn ($item) => ['id' => $item->id, 'reference' => $item->reference])->toArray();
                    $mission = formatForSelect($mission, 'reference');
                }
            }
        }

        if (isset(request()->filter['family'])) {
            $families = explode(',', request()->filter['family']);

            $domain = getDomains()
                ->whereIn('family_id', $families)
                ->get()
                ->map(fn ($item) => ['id' => $item->id, 'label' => $item->name])
                ->toArray();

            if (isset(request()->filter['domain'])) {
                $domains = explode(',', request()->filter['domain']);
                $process = getProcesses()
                    ->whereIn('domain_id', $domains)
                    ->get()
                    ->map(fn ($item) => ['id' => $item->id, 'label' => $item->name])
                    ->toArray();
            }
        }

        return compact('mission', 'campaign', 'dre', 'agency', 'family', 'domain', 'process');
    }

    /**
     * Filter data
     *
     * @param Builder $details
     * @param array $filter
     *
     * @return Builder
     */
    public function filter(Builder $details, array $filter): Builder
    {
        if (isset($filter['id'])) {
            $value = $filter['id'];
            $details = $details->having('md.id', "$value");
        }

        if (isset($filter['campaign'])) {
            $values = explode(',', $filter['campaign']);
            $details = $details->whereIn('control_campaign_id', $values);
        }

        if (isset($filter['mission'])) {
            $values = explode(',', $filter['mission']);
            $details = $details->whereIn('mission_id', $values);
        }

        if (isset($filter['score'])) {
            $values = explode(',', $filter['score']);
            $details = $details->whereIn('score', $values);
        }

        if (isset($filter['dre'])) {
            $values = explode(',', $filter['dre']);
            $details = $details->whereIn('dre_id', $values);
        }

        if (isset($filter['agency'])) {
            $values = explode(',', $filter['agency']);
            $details = $details->whereIn('agency_id', $values);
        }

        if (isset($filter['family'])) {
            $values = explode(',', $filter['family']);
            $details = $details->whereIn('family_id', $values);
        }

        if (isset($filter['domain'])) {
            $values = explode(',', $filter['domain']);
            $details = $details->whereIn('domain_id', $values);
        }

        if (isset($filter['process'])) {
            $values = explode(',', $filter['process']);
            $details = $details->whereIn('process_id', $values);
        }

        if (isset($filter['state'])) {
            $value = $filter['state'];
            if ($value == 'Levée') {
                $details = $details->where('reg_is_regularized', true);
            } elseif ($value == 'Rejetée') {
                $details = $details->where('reg_is_rejected', true);
            } elseif ($value == 'Non levée') {
                $details = $details->where('reg_is_sanitation_in_progress', false)->where('reg_is_regularized', false)->where('reg_is_rejected', false);
            } elseif ($value == 'En cours d\'assainissement') {
                $details = $details->where('reg_is_sanitation_in_progress', true);
            }
        }

        if (isset($filter['with_metadata'])) {
            $value = $filter['with_metadata'];
            if ($value == 'Oui') {
                $details = $details->whereNotNull('metadata');
            } else {
                $details = $details->whereNull('metadata');
            }
        }
        if (isset($filter['is_controlled'])) {
            if (hasRole('ci')) {
                $column = 'controlled_by_ci_at';
            } elseif (hasRole('cdc')) {
                $column = 'controlled_by_cdc_at';
            } elseif (hasRole('cdcr')) {
                $column = 'controlled_by_cdcr_at';
            } elseif (hasRole('cc')) {
                $column = 'controlled_by_cc_at';
            } elseif (hasRole('cdc')) {
                $column = 'controlled_by_dcp_at';
            } else {
                abort(404);
            }

            if ($filter['is_controlled'] == 'Non') {
                $details = $details->whereNull($column);
            } else {
                $details = $details->whereNotNull($column);
            }
        }
        return $details;
    }
}
