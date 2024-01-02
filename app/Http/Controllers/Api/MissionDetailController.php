<?php

namespace App\Http\Controllers\Api;

use App\Exports\MissionDetailExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\Detail\ControlRequest;
use App\Http\Resources\MissionDetailResource;
use App\Models\MissionDetail;
use App\Models\User;
use App\Notifications\Mission\MajorFact\Detected;
use App\Services\ExcelExportService;
use App\Traits\UploadFiles;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class MissionDetailController extends Controller
{
    use UploadFiles;

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
                $filename = 'détails_de_mission-' . $mission->campaign . $missionReference . \Str::slug($mission->dre . '-' . $mission->agency) . '.xlsx';
                $details = getMissionDetails($mission->id);
                return (new ExcelExportService($details, MissionDetailExport::class, $filename, $export))->download();
            }
            if ($sort) {
                $details = $details->sortByMultiple($sort);
            } else {
                $details = $details->orderBy('md.created_at', 'DESC');
            }

            if ($search) {
                $details = $details->search(['cp.name'], $search);
            }

            if ($filter) {
                $details = $this->filter($details, $filter);
            }

            $details = MissionDetailResource::collection($details->paginate($perPage)->onEachSide(1));
            return $details;
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    private function details()
    {
        $details = MissionDetail::with([
            'controlPoint'  => fn ($query) => $query->with(['process'  => fn ($query) => $query->with(['domain'  => fn ($query) => $query->with('family')])]),
            'agency'  => fn ($query) => $query->with('dre'),
            'mission' => fn ($query) => $query->with(['campaign'])
        ]);

        $user = auth()->user();
        if (hasRole('dcp')) {
            $details = $details->hasCdcValidation();
        } elseif (hasRole('cdcr')) {
            $details = $details->hasCdcValidation();
        } elseif (hasRole(['cdc', 'cc', 'ci'])) {
            $details = $user->details()->controlled();
        } elseif (hasRole(['dg', 'cdrcp', 'der', 'deac', 'dga'])) {
            $details = $details->hasDcpValidation();
        } elseif (hasRole('dre')) {
            $details = $user->details()->hasDcpValidation();
        } elseif (hasRole('da')) {
            $details = $user->details()->hasDcpValidation();
        } else {
            $details = $details;
        }
        return $details->whereAnomaly()->withoutMajorFacts();
    }
    /**
     * Enregistre les informations de la mission dans la base de donéees
     *
     * @param ControlRequest $request
     *
     * @return Illuminate\Http\Response
     */
    public function control(ControlRequest $request)
    {
        $data = $request->validated();
        $files = $data['media'];
        unset($data['media']);
        $data['metadata'] = isset($data['metadata']) ? array_map(function ($lines) {
            return array_map(function ($line) {
                $key = $line['key'];
                $value = $line['value'];
                $line[$key] = $value;
                return $line;
            }, $lines);
        }, $data['metadata']) : [];
        $this->handleMetadata($data);
        $data['metadata'] = count($data['metadata']) ? json_encode($data['metadata']) : null;
        try {
            DB::transaction(function () use ($data, $files) {
                $detail = MissionDetail::findOrFail($data['detail']);
                unset($data['detail']);
                $this->updateDetail($data, $detail);
            });
            return response()->json([
                'message' => 'Les renseignements sur le point de contrôle sont sauvegardés avec succès.',
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ]);
        }
    }

    public function show(MissionDetail $detail)
    {
        $detail->unsetRelations();
        $diffInDays = Carbon::parse($detail->mission->dcp_validation_at)->diffInDays(today());
        $detail->show_regularizations = $diffInDays >= 11 || $detail->mission->is_validated_by_da || hasRole('da');
        if ($detail->show_regularization) {
            $detail->load('regularizations');
        }

        $detail->load('mission', 'media', 'dre', 'agency', 'campaign', 'family', 'domain', 'process', 'controlPoint', 'controlPoint.fields');
        return $detail;
    }

    private function handleMetadata($data, $multiple = false, $rowKey = null)
    {
        if (count($data['metadata'])) {
            foreach ($data['metadata'] as $rowKey => $row) {
                $fields = DB::table('mission_details', 'md')
                    ->select('f.*')
                    ->leftJoin('control_points AS cp', 'md.control_point_id', 'cp.id')
                    ->leftJoin('has_fields AS hf', 'cp.id', 'hf.attachable_id')
                    ->leftJoin('fields AS f', 'hf.field_id', 'f.id')
                    ->where('attachable_type', 'App\Models\ControlPoint')
                    ->where('md.id', $data['detail'])
                    ->get();
                if ($fields->count()) {
                    validateFields($fields, $data, $multiple, $rowKey);
                }
            }
        }
    }


    /**
     * Notify  concerned users
     *
     * @param App\Models\MissionDetail $detail
     * @param array $roles
     */
    private function notifyMajorFact(MissionDetail $detail): void
    {
        if ($detail->major_fact) {
            $users = collect([]);
            if (hasRole('ci')) {
                $users = $users->push($detail->mission->creator);
            } elseif (hasRole(['cdc', 'cc'])) {
                $users = User::whereRoles(['cdcr', 'dcp'])->isActive()->get();
            } elseif (hasRole('cdcr')) {
                $users = User::whereRoles(['dcp'])->isActive()->get();
            } elseif (hasRole('dcp')) {
                $users = User::whereRoles(['dg', 'sg', 'ig', 'dga', 'der', 'deac'])->isActive()->get();
            }
            foreach ($users as $user) {
                if (!$user->notifications()->where('data->detail_id', $detail->id)->count()) {
                    Notification::send($user, new Detected($detail));
                }
            }
        }
    }

    /**
     * Update mission detail
     *
     * @param array $data
     * @param App\Models\MissionDetail $detail
     *
     * @return App\Models\MissionDetail
     */
    private function updateDetail(array $data, MissionDetail $detail)
    {
        return DB::transaction(function () use ($detail, $data) {
            $oldMajorFactValue = $detail->major_fact;
            $currentMode = $data['currentMode'];
            // Vidé les champs report, recovery_plan, metadata
            if (isset($data['score']) && $data['score'] == 1) {
                $data['recovery_plan'] = null;
            }

            $reportColumn = null;
            if (isset($data['report'])) {
                if (hasRole('ci')) {
                    $reportColumn = 'ci_report';
                } else {
                    if ($data['report'] !== 'ci_report') {
                        $reportColumn = 'cdc_report';
                    }
                }
            }

            $newData = [
                'score' => isset($data['score']) ? $data['score'] : $detail->score,
                'recovery_plan' => isset($data['recovery_plan']) ? $data['recovery_plan'] : null,
                'metadata' => $data['metadata'],
            ];

            if ($reportColumn) {
                $newData[$reportColumn] = isset($data['report']) ? $data['report'] : $detail->report;
            }
            $userFullName = auth()->user()->full_name . ' (' . auth()->user()->role->code . ')';
            if (hasRole('ci')) {
                $newData['controlled_by_ci_at'] = now();
                $newData['controlled_by_ci_id'] = auth()->user()->id;
            } elseif (hasRole('cdc')) {
                $newData['controlled_by_cdc_at'] = now();
                $newData['controlled_by_cdc_id'] = auth()->user()->id;
                $newData['cdc_full_name'] = $userFullName;
            } elseif (hasRole('cc')) {
                $newData['controlled_by_cc_at'] = now();
                $newData['controlled_by_cc_id'] = auth()->user()->id;
            } elseif (hasRole('cdcr')) {
                $newData['controlled_by_cdcr_at'] = now();
                $newData['controlled_by_cdcr_id'] = auth()->user()->id;
                $newData['cdcr_full_name'] = $userFullName;
            } elseif (hasRole('dcp')) {
                $newData['controlled_by_dcp_at'] = now();
                $newData['controlled_by_dcp_id'] = auth()->user()->id;
                $newData['dcp_full_name'] = $userFullName;
            } else {
                abort(404, 'Le rôle de l\'utilisateur n\'est pas pri en charge.');
            }

            // Mettre la note max si jamais il y'a un fait majeur
            if (isset($data['major_fact']) && !empty($data['major_fact']) && $data['major_fact'] && !$detail->major_fact) {
                $newData['score'] = max(array_keys($detail->controlPoint->scores_arr));
                $newData['major_fact'] = $data['major_fact'];
                $newData['major_fact_is_rejected'] = false;
                $newData['major_fact_is_detected_by_full_name'] = $userFullName;
                $newData['major_fact_is_detected_by_id'] = auth()->user()->id;
                $newData['major_fact_is_detected_at'] = now();

                if (hasRole(['cdc', 'cc', 'cdcr'])) {
                    $newData['major_fact_is_dispatched_to_dcp_at'] = now();
                    $newData['major_fact_is_dispatched_to_dcp_by_full_name'] = $userFullName;
                    $newData['major_fact_is_dispatched_to_dcp_by_id'] = auth()->user()->id;
                } elseif (hasRole(['dcp'])) {
                    $newData['major_fact_is_dispatched_at'] = now();
                    $newData['major_fact_is_dispatched_by_full_name'] = $userFullName;
                    $newData['major_fact_is_dispatched_by_id'] = auth()->user()->id;
                }
            }

            $detail->update($newData);

            // Mise à jour de la date réel du début de la mission
            if ($currentMode == 1 && !$detail->mission->real_start && $detail->mission->details()->controlled()->count() == 1) {
                $detail->mission->update(['real_start' => now()]);
            }

            // Mise à jour de la date réel de la fin de mission
            if ($currentMode == 1 && !$detail->mission->real_end && $detail->mission->details()->count() == $detail->mission->details()->controlled()->count()) {
                $detail->mission->update(['real_end' => now()]);
            }

            if ($detail->major_fact && !$oldMajorFactValue) {
                $this->notifyMajorFact($detail);
            }

            return $detail;
        });
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
        $dre = hasRole(['cdc', 'ci', 'dre', 'da']) ? [$user->dre] : [];
        $agency = hasRole(['cdc', 'ci', 'dre', 'da']) ? formatForSelect($user->agencies->toArray(), 'full_name') : [];
        $campaign = formatForSelect(getControlCampaigns()->get()->map(fn ($item) => ['id' => $item->id, 'reference' => $item->reference])->toArray(), 'reference');
        $mission = [];
        if (isset(request()->filter['campaign'])) {

            $campaigns = explode(',', request()->filter['campaign']);

            $dre = getDre()
                ->join('agencies as a', 'd.id', 'a.dre_id')
                ->join('missions as m', 'm.agency_id', 'a.id')
                ->join('mission_details as md', 'md.mission_id', 'm.id')
                ->whereIn('md.score', [2, 3, 4])
                ->whereIn('m.control_campaign_id', $campaigns)
                ->get()
                ->map(fn ($item) => ['id' => $item->id, 'full_name' => $item->full_name])->toArray();
            $dre = formatForSelect($dre, 'full_name');

            if (isset(request()->filter['dre'])) {
                $dres = explode(',', request()->filter['dre']);
                $agency = getAgencies()
                    ->join('missions as m', 'm.agency_id', 'a.id')
                    ->join('mission_details as md', 'md.mission_id', 'm.id')
                    ->whereIn('md.score', [2, 3, 4])
                    ->whereIn('dre_id', $dres)
                    ->get()
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

        if (isset($filter['is_regularized'])) {
            $value = $filter['is_regularized'] == 'Non levée' ? 0 : 1;
            $details = $details->where('is_regularized', $value);
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
