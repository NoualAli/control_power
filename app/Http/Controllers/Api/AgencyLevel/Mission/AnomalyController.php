<?php

namespace App\Http\Controllers\Api\AgencyLevel\Mission;

use App\DB\Queries\ControlCampaignQuery;
use App\DB\Queries\MissionAnomalyQuery;
use App\DB\Queries\MissionDetailQuery;
use App\DB\Queries\MissionQuery;
use App\Exports\MissionDetailExport;
use App\Http\Controllers\Controller;
use App\Http\Resources\AnomalyResource;
use App\Models\ControlCampaign;
use App\Models\Mission;
use App\Services\ExcelExportService;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnomalyController extends Controller
{
    /**
     * @return Illuminate\Http\JsonResponse
     */
    public function index(?ControlCampaign $campaign = null, ?Mission $mission = null)
    {
        isAbleOrAbort(['view_mission_detail']);
        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);

        $export = request('export', []);
        $shouldExport = count($export) || request()->has('export');
        try {
            $searchColumns = ['md.reference', 'cp.name'];
            $details = (new MissionAnomalyQuery)->prepare([
                'sort' => ['sort' => $sort],
                'search' => ['columns' => $searchColumns, 'value' => $search],
            ])->multiple();

            if ($fetchFilters) {
                return $this->filters($details);
            }

            if ($campaign) {
                $details = $details->where('cc.id', $campaign->id);
            }

            if ($mission) {
                $details = $details->where('m.id', $mission->id);
            }

            if ($shouldExport) {
                $mission = (new MissionQuery)->prepare()->single(request('mission'));
                $missionReference = $mission->reference ? '-' . str_replace('/', '-', $mission->reference) . '-' : null;
                $filename = 'détails_de_mission-' . $mission->campaign . $missionReference . Str::slug($mission->dre . '-' . $mission->agency) . '.xlsx';
                $details = (new MissionDetailQuery)->prepare()->where('mission_id', $mission->id)->first();
                return (new ExcelExportService($details, MissionDetailExport::class, $filename, $export))->download();
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
    // public function filters(Builder $details): array
    // {
    //     $filter = request('filter');
    //     $campaignRequest = isset($filter['campaign']) && !empty($filter['campaign']) ? $filter['campaign'] : null;
    //     $dreRequest = isset($filter['dre']) && !empty($filter['dre']) ? $filter['dre'] : null;
    //     $agencyRequest = isset($filter['agency']) && !empty($filter['agency']) ? $filter['agency'] : null;
    //     $missionRequest = isset($filter['mission']) && !empty($filter['mission']) ? $filter['mission'] : null;
    //     $familyRequest = isset($filter['family']) && !empty($filter['family']) ? $filter['family'] : null;
    //     $domainRequest = isset($filter['domain']) && !empty($filter['domain']) ? $filter['domain'] : null;
    //     $processRequest = isset($filter['process']) && !empty($filter['process']) ? $filter['process'] : null;
    //     $stateRequest = isset($filter['state']) && !empty($filter['state']) ? $filter['state'] : null;
    //     $scoreRequest = isset($filter['score']) && !empty($filter['score']) ? $filter['score'] : null;
    //     $withMetadataRequest = isset($filter['with_metadata']) && !empty($filter['with_metadata']) ? $filter['with_metadata'] : null;

    //     $fullMissionRequest = request('mission');
    //     $fullCampaignRequest = request('campaign');

    //     $user = auth()->user();
    //     $missions = !empty($fullMissionRequest) ?: explode(',', $fullMissionRequest);
    //     if (is_array($missions) && count($missions) == 1) {
    //         $missions = $missions[0];
    //     }
    //     $missionId = $fullMissionRequest?->id;
    //     $missionReference = $fullMissionRequest?->reference;
    //     $campaignId = request('campaign')?->id;

    //     $campaign = [];
    //     $mission = [];
    //     if (!$campaignId) {
    //         $campaign = (new ControlCampaignQuery)->query->whereNotNull('validated_at')->orderBy('reference', 'DESC')->get();
    //     }
    //     if (!$missionId) {
    //         $mission = (new MissionQuery)->query;
    //         if ($campaignId) {
    //             $mission = $mission->where(function ($query) use ($campaign) {
    //                 $query->whereIn('cc.id', $campaign->only('id')->toArray());
    //             });
    //         }
    //         $family = getFamilies()->select(['f.id', 'f.name'])
    //             ->leftJoin('mission_detail_regularizations AS mdr', 'mdr.mission_detail_id', 'md.id')
    //             ->whereNot('md.major_fact', true);
    //         $family = $family->where('md.mission_id', $missionId);
    //     }
    //     $details = $details->where('md.mission_id', $missionId);
    //     $dres = [];
    //     if (isset($dreRequest) && !empty($dreRequest)) {
    //         $dres = explode(',', $dreRequest);
    //     }

    //     $dre = getDre()->leftJoin('agencies AS a', 'a.dre_id', 'd.id');
    //     $agency = [];

    //     if (!empty($dres)) {
    //         $agency = getAgencies()->leftJoin('dres AS d', 'd.id', 'a.dre_id')
    //             ->whereIn('d.id', $dres);
    //         if (!empty($campaignRequest)) {
    //             $agency = $agency->join('missions AS m', 'm.agency_id', 'a.id')->join('control_campaigns AS cc', 'cc.id', 'm.control_campaign_id')->whereIn('cc.id', explode(',', $campaignRequest));
    //         }
    //     }

    //     $details = $details->get();

    //     $scores = [2, 3, 4];

    //     if (isset($scoreRequest)) {
    //         $scores = explode(',', $scoreRequest);
    //         $details = $details->filter(fn ($item) => in_array($item->score, $scores));
    //     }

    //     if (isset($stateRequest)) {
    //         $states = explode(',', $stateRequest);
    //         foreach ($states as $state) {
    //             if ($state == 'Levée') {
    //                 $details = $details->filter(fn ($item) => (int) $item->reg_is_regularized == 1);
    //             }

    //             if ($state == 'En cours d\'assainissement') {
    //                 $details = $details->filter(fn ($item) => (int) $item->reg_is_sanitation_in_progress == 1);
    //             }

    //             if ($state == 'En attente de traitement') {
    //                 $details = $details->filter(fn ($item) => (int) $item->total_regularizations == 0);
    //             }

    //             if ($state == 'Rejeté') {
    //                 $details = $details->filter(fn ($item) => (int) $item->reg_is_rejected == 1);
    //             }
    //         }
    //     }

    //     if (isset($stateRequest)) {
    //         $states = explode(',', $stateRequest);
    //         foreach ($states as $state) {
    //             if ($state == 'Levée') {
    //                 $family = $family->where('reg_is_regularized', '1');
    //             }

    //             if ($state == 'En cours d\'assainissement') {
    //                 $family = $family->where('reg_is_sanitation_in_progress', '1');
    //             }

    //             if ($state == 'En attente de traitement') {
    //                 $family = $family->having(DB::raw('COUNT(mdr.id)'), 0);
    //             }

    //             if ($state == 'Rejeté') {
    //                 $family = $family->where('reg_is_rejected', '1');
    //             }
    //         }
    //     }

    //     $family = $family->get()
    //         ->map(fn ($item) => ['id' => $item->id, 'label' => $item->name])->toArray();
    //     $domain = [];
    //     $process = [];
    //     $score = (clone $details);
    //     if ($missionId) {
    //         $score = $score->filter(fn ($item) => $item->mission == 'RAP' . $missionReference);
    //     }

    //     // Fetch domains
    //     if (isset($familyRequest)) {
    //         $families = explode(',', $familyRequest);
    //         $score = $score->filter(fn ($item) => in_array($item->family_id, $families));
    //         $details = $details->filter(fn ($item) => in_array($item->family_id, $families));
    //         $domain = getDomains()->select(['d.id', 'd.name'])
    //             ->leftJoin('mission_detail_regularizations AS mdr', 'mdr.mission_detail_id', 'md.id')
    //             ->whereIn('family_id', $families)
    //             ->whereNot('md.major_fact', true)
    //             ->whereIn('md.score', $scores);

    //         if ($missionId) {
    //             $domain = $domain->where('md.mission_id', $missionId);
    //         }

    //         if (isset($stateRequest)) {
    //             $states = explode(',', $stateRequest);
    //             foreach ($states as $state) {
    //                 if ($state == 'Levée') {
    //                     $domain = $domain->where('reg_is_regularized', '1');
    //                 }

    //                 if ($state == 'En cours d\'assainissement') {
    //                     $domain = $domain->where('reg_is_sanitation_in_progress', '1');
    //                 }

    //                 if ($state == 'En attente de traitement') {
    //                     $domain = $domain->having(DB::raw('COUNT(mdr.id)'), '0');
    //                 }

    //                 if ($state == 'Rejeté') {
    //                     $domain = $domain->where('reg_is_rejected', '1');
    //                 }
    //             }
    //         }

    //         $domain = $domain
    //             ->get()
    //             ->map(fn ($item) => ['id' => $item->id, 'label' => $item->name])
    //             ->toArray();

    //         // Fetch processes
    //         if (isset($domainRequest)) {
    //             $domains = explode(',', $domainRequest);
    //             $score = $score->filter(fn ($item) => in_array($item->domain_id, $domains));
    //             $details = $details->filter(fn ($item) => in_array($item->domain_id, $domains));
    //             $process = getProcesses()
    //                 ->leftJoin('mission_detail_regularizations AS mdr', 'mdr.mission_detail_id', 'md.id')
    //                 ->whereIn('family_id', $families)
    //                 ->whereIn('domain_id', $domains)
    //                 ->whereNot('md.major_fact', true)
    //                 ->whereIn('md.score', $scores);
    //             if ($missionId) {
    //                 $process = $process->where('md.mission_id', $missionId);
    //             }
    //             if (isset($stateRequest)) {
    //                 $states = explode(',', $stateRequest);
    //                 foreach ($states as $state) {
    //                     if ($state == 'Levée') {
    //                         $process = $process->where('reg_is_regularized', '1');
    //                     }

    //                     if ($state == 'En cours d\'assainissement') {
    //                         $process = $process->where('reg_is_sanitation_in_progress', '1');
    //                     }

    //                     if ($state == 'En attente de traitement') {
    //                         $process = $process->having(DB::raw('COUNT(mdr.id)'), '0');
    //                     }

    //                     if ($state == 'Rejeté') {
    //                         $process = $process->where('reg_is_rejected', '1');
    //                     }
    //                 }
    //             }
    //             $process = $process
    //                 ->get()
    //                 ->map(fn ($item) => ['id' => $item->id, 'label' => $item->name])
    //                 ->toArray();
    //             if (isset($processRequest)) {
    //                 $processes = explode(',', $processRequest);
    //                 $details = $details->filter(fn ($item) => in_array($item->process_id, $processes));
    //             }
    //         }
    //     }

    //     $score = $score->unique('score')->sortBy('score')->pluck('score')->toArray();
    //     $score = array_map(function ($item) {
    //         return ['id' => $item, 'label' => $item];
    //     }, $score);

    //     $state = collect([]);
    //     if ($details->contains('reg_is_regularized', '1')) {
    //         $state->push(['id' => 'Levée', 'label' => 'Levée']);
    //     }
    //     if ($details->contains('reg_is_rejected', '1')) {
    //         $state->push(['id' => 'Rejetée', 'label' => 'Rejetée']);
    //     }
    //     if ($details->contains('reg_is_sanitation_in_progress', '1')) {
    //         $state->push(['id' => 'En cours d\'assainissement', 'label' => 'En cours d\'assainissement']);
    //     }
    //     if ($details->contains(fn ($item) => (int) $item->total_regularizations == 0)) {
    //         $state->push(['id' => 'En attente de traitement', 'label' => 'En attente de traitement']);
    //     }

    //     $state = $state->toArray();
    //     if (!$campaignId) {
    //         $campaign = formatForSelect($campaign->toArray(), 'reference');
    //     }
    //     if (!$missionId) {
    //         $mission = formatForSelect($mission->get()->toArray(), 'reference');
    //     }

    //     if (!$campaignId && !$missionId) {
    //         $dre = formatForSelect($dre->get()->toArray(), 'full_name');
    //     }
    //     if (!empty($dres)) {
    //         $agency = formatForSelect($agency->get()->toArray(), 'full_name');
    //     }

    //     return compact('family', 'domain', 'process', 'score', 'state', 'mission', 'campaign', 'dre', 'agency');
    // }

    /**
     * Get details filters data
     *
     * @param Builder $details
     *
     * @return array
     */
    public function filters(Builder $details): array
    {
        $filter = request('filter');
        $campaignFilter = isset($filter['campaign']) && !empty($filter['campaign']) ? explode(',', $filter['campaign']) : null;
        $dreFilter = isset($filter['dre']) && !empty($filter['dre']) ? explode(',', $filter['dre']) : null;
        $agencyFilter = isset($filter['agency']) && !empty($filter['agency']) ? explode(',', $filter['agency']) : null;
        $missionFilter = isset($filter['mission']) && !empty($filter['mission']) ? explode(',', $filter['mission']) : null;
        $familyFilter = isset($filter['family']) && !empty($filter['family']) ? explode(',', $filter['family']) : null;
        $domainFilter = isset($filter['domain']) && !empty($filter['domain']) ? explode(',', $filter['domain']) : null;
        $processFilter = isset($filter['process']) && !empty($filter['process']) ? explode(',', $filter['process']) : null;
        $stateFilter = isset($filter['state']) && !empty($filter['state']) ? explode(',', $filter['state']) : null;
        $scoreFilter = isset($filter['score']) && !empty($filter['score']) ? explode(',', $filter['score']) : null;
        $withMetadataFilter = isset($filter['with_metadata']) && !empty($filter['with_metadata']) ? $filter['with_metadata'] : null;

        $fullMissionRequest = request('mission');
        $fullCampaignRequest = request('campaign');

        $user = auth()->user();

        $missionId = $fullMissionRequest?->id;
        $missionReference = $fullMissionRequest?->reference;
        $campaignId = $fullCampaignRequest?->id;

        $campaign = (new ControlCampaignQuery)->prepare()->query->select('cc.id', 'cc.reference');
        $mission = (new MissionQuery)->prepare()->query;
        $dre = getDre();
        if (!$campaignId) {
            $campaign = $campaign->whereNotNull('cc.validated_at')->orderBy('cc.reference', 'DESC');
        }
        $campaign = $campaign->get();
        if (gettype($fullMissionRequest) !== 'object' && !empty($campaignFilter)) {
            $mission = $mission->whereIn('control_campaign_id', $campaignFilter);
            if (!empty($dreFilter)) {
                $mission = $mission->whereIn('d.id', $dreFilter);
                if (!empty($agencyFilter)) {
                    $mission = $mission->whereIn('a.id', $agencyFilter);
                }
            }
        }

        if (gettype($fullMissionRequest) == 'object') {
            $mission = $mission->where(function ($query) use ($campaign) {
                $query->whereIn('cc.id', $campaign->only('id')->toArray());
            });
            if (!empty($missionFilter)) {
                $mission = $mission->whereIn('m.id', $missionFilter);
            }
        }
        if (is_array($campaignFilter)) {
            $dre = $dre->leftJoin('agencies AS a', 'a.dre_id', 'd.id')
                ->leftJoin('missions AS m', 'a.id', 'm.agency_id')
                ->leftJoin('control_campaigns AS cc', 'cc.id', 'm.control_campaign_id')
                ->whereIn('cc.id', $campaignFilter);
        }

        $agency = getAgencies();

        if (!empty($dreFilter)) {
            $agency = $agency->whereIn('dre_id', $dreFilter);
        }

        if (!empty($campaignFilter)) {
            $agency = $agency->leftJoin('missions AS m', 'm.agency_id', 'a.id')->leftJoin('control_campaigns AS cc', 'cc.id', 'm.control_campaign_id')->whereIn('cc.id', $campaignFilter);
        }

        if (gettype($fullMissionRequest) == 'object') {
            $details = $details->where('md.mission_id', $missionId);
        }

        $score = [2, 3, 4];
        $family = getFamilies()->select(['f.id', 'f.name'])
            ->leftJoin('mission_detail_regularizations AS mdr', 'mdr.mission_detail_id', 'md.id')
            ->whereNot('md.major_fact', true);
        if ($missionId) {
            $family = $family->where('md.mission_id', $missionId);
        }

        // if (is_array($scoreFilter)) {
        //     $details = $details->filter(fn ($item) => in_array($item->score, $scoreFilter));
        // }

        if (is_array($stateFilter)) {
            foreach ($stateFilter as $state) {
                if ($state == 'Levée') {
                    // $details = $details->filter(fn ($item) => (int) $item->reg_is_regularized == 1);
                    $details = $details->where('reg_is_regularized', 1);
                }

                if ($state == 'En cours d\'assainissement') {
                    // $details = $details->filter(fn ($item) => (int) $item->reg_is_sanitation_in_progress == 1);
                    $details = $details->where('reg_is_sanitation_in_progress', 1);
                }

                if ($state == 'En attente de traitement') {
                    // $details = $details->filter(fn ($item) => (int) $item->total_regularizations == 0);
                    $details = $details->where('total_regularizations', 0);
                }

                if ($state == 'Rejeté') {
                    // $details = $details->filter(fn ($item) => (int) $item->reg_is_rejected == 1);
                    $details = $details->where('reg_is_rejected', 1);
                }
            }
        }

        if (is_array($stateFilter)) {
            foreach ($stateFilter as $state) {
                if ($state == 'Levée') {
                    $family = $family->where('reg_is_regularized', '1');
                }

                if ($state == 'En cours d\'assainissement') {
                    $family = $family->where('reg_is_sanitation_in_progress', '1');
                }

                if ($state == 'En attente de traitement') {
                    $family = $family->having(DB::raw('COUNT(mdr.id)'), 0);
                }

                if ($state == 'Rejeté') {
                    $family = $family->where('reg_is_rejected', '1');
                }
            }
        }

        $family = $family->get()
            ->map(fn ($item) => ['id' => $item->id, 'label' => $item->name])->toArray();
        $domain = [];
        $process = [];
        // $score = (clone $details);
        // if ($missionId) {
        //     $score = $score->filter(fn ($item) => $item->mission == 'RAP' . $missionReference);
        // }

        // Fetch domains
        if (is_array($familyFilter)) {
            $details = $details->whereIn('f.id', $familyFilter);
            $domain = getDomains()->select(['d.id', 'd.name'])
                ->leftJoin('mission_detail_regularizations AS mdr', 'mdr.mission_detail_id', 'md.id')
                ->whereIn('family_id', $familyFilter)
                ->whereNot('md.major_fact', true)
                ->whereIn('md.score', $score);

            if ($missionId) {
                $domain = $domain->where('md.mission_id', $missionId);
            }

            if (is_array($stateFilter)) {
                foreach ($stateFilter as $state) {
                    if ($state == 'Levée') {
                        $domain = $domain->where('reg_is_regularized', '1');
                    }

                    if ($state == 'En cours d\'assainissement') {
                        $domain = $domain->where('reg_is_sanitation_in_progress', '1');
                    }

                    if ($state == 'En attente de traitement') {
                        $domain = $domain->having(DB::raw('COUNT(mdr.id)'), '0');
                    }

                    if ($state == 'Rejeté') {
                        $domain = $domain->where('reg_is_rejected', '1');
                    }
                }
            }

            $domain = $domain
                ->get()
                ->map(fn ($item) => ['id' => $item->id, 'label' => $item->name])
                ->toArray();

            // Fetch processes
            if (is_array($domainFilter)) {
                $details = $details->whereIn('d.id', $domainFilter);
                $process = getProcesses()
                    ->leftJoin('mission_detail_regularizations AS mdr', 'mdr.mission_detail_id', 'md.id')
                    ->whereIn('family_id', $familyFilter)
                    ->whereIn('domain_id', $domainFilter)
                    ->whereNot('md.major_fact', true)
                    ->whereIn('md.score', $score);
                if ($missionId) {
                    $process = $process->where('md.mission_id', $missionId);
                }
                if (is_array($stateFilter)) {
                    foreach ($stateFilter as $state) {
                        if ($state == 'Levée') {
                            $process = $process->where('reg_is_regularized', '1');
                        }

                        if ($state == 'En cours d\'assainissement') {
                            $process = $process->where('reg_is_sanitation_in_progress', '1');
                        }

                        if ($state == 'En attente de traitement') {
                            $process = $process->having(DB::raw('COUNT(mdr.id)'), '0');
                        }

                        if ($state == 'Rejeté') {
                            $process = $process->where('reg_is_rejected', '1');
                        }
                    }
                }
                $process = $process
                    ->get()
                    ->map(fn ($item) => ['id' => $item->id, 'label' => $item->name])
                    ->toArray();
                // if (is_array($processFilter)) {
                //     $details = $details->filter(fn ($item) => in_array($item->process_id, $processFilter));
                // }
            }
        }

        $state = collect([
            ['id' => 'Levée', 'label' => 'Levée'],
            ['id' => 'Rejetée', 'label' => 'Rejetée'],
            ['id' => 'En cours d\'assainissement', 'label' => 'En cours d\'assainissement'],
            ['id' => 'En attente de traitement', 'label' => 'En attente de traitement']
        ])->toArray();

        if (!$campaignId) {
            $campaign = formatForSelect($campaign->toArray(), 'reference');
        } else {
            $campaign = [];
        }
        if (!empty($missionFilter) || !empty($campaignFilter)) {
            $mission = formatForSelect($mission->get()->toArray(), 'reference');
        } else {
            $mission = [];
        }

        if (!$campaignId && !$missionId) {
            $dre = formatForSelect($dre->get()->toArray(), 'full_name');
        } else {
            $dre = [];
        }
        if (!empty($dreFilter)) {
            $agency = formatForSelect($agency->get()->toArray(), 'full_name');
        } else {
            $agency = [];
        }
        $score = collect([
            ['id' => 2, 'label' => 2],
            ['id' => 3, 'label' => 3],
            ['id' => 4, 'label' => 4],
        ])->toArray();
        return compact('family', 'domain', 'process', 'score', 'state', 'mission', 'campaign', 'dre', 'agency');
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
            $details = $details->whereIn('md.mission_id', $values);
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
            } elseif ($value == 'En attente de traitement') {
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
