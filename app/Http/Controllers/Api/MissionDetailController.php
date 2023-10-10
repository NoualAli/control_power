<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\Detail\ControlRequest;
use App\Http\Resources\MissionDetailResource;
use App\Models\Media;
use App\Models\MissionDetail;
use App\Models\User;
use App\Notifications\Mission\MajorFact\Detected;
use App\Traits\UploadFiles;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Predis\Client;

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
        $fetchAll = request()->has('fetchAll');

        $details = getMissionDetails()->whereIn('score', [2, 3, 4])->where('major_fact', false);

        try {
            if ($fetchFilters) {
                return $this->filters($details);
            }
            if (request()->has('campaign_id')) {
                $details = $details->where('control_campaign_id', request()->campaign_id);
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
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], 500);
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
        } elseif (hasRole(['dg', 'cdrcp', 'der'])) {
            $details = $details->hasDcpValidation();
        } elseif (hasRole('dre')) {
            $details = $user->details()->hasDcpValidation();
        } elseif (hasRole('da')) {
            $details = $user->details()->hasDcpValidation();
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
        $this->validateMetadata($data);

        try {
            DB::transaction(function () use ($data, $files) {
                $detail = MissionDetail::findOrFail($data['detail']);
                unset($data['detail']);
                $this->updateDetail($data, $detail);
                $this->storeFiles($files, $detail);
                if (hasRole('ci')) {
                    $this->notifyMajorFact($detail);
                }
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
        $detail->load('regularization', 'mission', 'media', 'dre', 'agency', 'campaign', 'family', 'domain', 'process', 'controlPoint');
        return $detail;
    }

    /**
     * Validate metadata of each row
     *
     * @param array $data
     *
     * @return void
     */
    private function validateMetadata(array $data)
    {
        if (array_key_exists('rows', $data)) {
            foreach ($data['rows'] as $rowKey => $row) {
                $this->handleMetadata($row, $rowKey);
            }
        } else {
            $this->handleMetadata($data);
        }
    }

    private function handleMetadata($data, $multiple = false, $rowKey = null)
    {
        $detail = MissionDetail::findOrFail($data['detail']);;
        $controlPointFields = $detail->controlPoint->fields;
        if ($controlPointFields) {
            foreach ($controlPointFields as $key => $field) {
                $name = $field[2]->name;
                $rules = array_key_exists(8, $field) ? $field[8]->rules : [];
                $length = $field[3]->length;
                if ($length) {
                    $rules = array_merge($rules, ['string', 'max:' . $field[3]->length]);
                }
                if ($multiple) {
                    $computedName = 'rows.' . $rowKey . '.metadata.*.' . $key . '.' . $name;
                } else {
                    $computedName = 'metadata.*.' . $key . '.' . $name;
                }
                Validator::make($data, [$computedName => $rules])->validate();
            }
        }
    }

    /**
     * Store files informations to database
     *
     * @param array $files
     * @param App\Models\MissionDetail $detail
     */
    private function storeFiles(array $files, MissionDetail $detail)
    {
        if (is_array($files)) {
            $media = Media::whereIn('id', $files)->get();
            foreach ($media as $file) {
                if (empty($file->attachable_type)) {
                    $file->update([
                        'attachable_type' => MissionDetail::class,
                        'attachable_id' => $detail->id,
                    ]);
                }
            }
        }
    }

    /**
     * Notifier CDRCP, DCP, CDCR, CDC
     *
     * @param App\Models\MissionDetail $detail
     */
    private function notifyMajorFact(MissionDetail $detail, $roles = ['dcp', 'cdcr'])
    {
        if ($detail->major_fact) {
            $users = User::all()->filter(fn ($user) => hasRole($roles, $user) || $detail->mission->creator->id == $user->id);
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
            $currentMode = $data['currentMode'];

            // Vidé les champs report, recovery_plan, metadata
            if (isset($data['score']) && $data['score'] == 1) {
                // $data['report'] = null;
                $data['recovery_plan'] = null;
                $data['metadata'] = null;
            }
            // Mettre la note max si jamais il y'a un fait majeur
            if (isset($data['major_fact']) && !empty($data['major_fact'])) $data['score'] = max(array_keys($detail->controlPoint->scores_arr));

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

            // Mise à jour des informations dans la base de données
            $metadata = isset($data['metadata']) && !empty($data['metadata']) ? $data['metadata'] : $detail->metadata;
            $newData = [
                'major_fact' => $data['major_fact'],
                'score' => isset($data['score']) ? $data['score'] : $detail->score,
                'recovery_plan' => isset($data['recovery_plan']) ? $data['recovery_plan'] : $detail->recovery_plan,
                'metadata' => $metadata,
            ];

            if ($reportColumn) {
                $newData[$reportColumn] = isset($data['report']) ? $data['report'] : $detail->report;
            }

            if (hasRole('ci')) {
                $newData['controlled_by_ci_at'] = now();
                $newData['controlled_by_ci_id'] = auth()->user()->id;
                if ($detail->major_fact) {
                    unset($newData['major_fact']);
                }
            } elseif (hasRole('cdc')) {
                $newData['controlled_by_cdc_at'] = now();
                $newData['controlled_by_cdc_id'] = auth()->user()->id;
                if ($detail->is_controlled_by_ci && $detail->major_fact) {
                    unset($newData['major_fact']);
                }
            } elseif (hasRole('cc')) {
                $newData['controlled_by_cc_at'] = now();
                $newData['controlled_by_cc_id'] = auth()->user()->id;
                if ($detail->is_controlled_by_cc) {
                    unset($newData['major_fact']);
                }
            } elseif (hasRole('cdcr')) {
                $newData['controlled_by_cdcr_at'] = now();
                $newData['controlled_by_cdcr_id'] = auth()->user()->id;
            } elseif (hasRole('dcp')) {
                $newData['controlled_by_dcp_at'] = now();
                $newData['controlled_by_dcp_id'] = auth()->user()->id;
            } else {
                abort(500, 'Le rôle de l\'utilisateur n\'est pas pri en charge.');
            }



            if ($detail->is_dispatched) {
                unset($newData['major_fact']);
            }

            $detail->update($newData);

            // Mise à jour de la date réel du début de la mission
            if ($currentMode == 1 && !$detail->reel_start) {
                $detail->mission->update(['reel_start' => now()]);
            }

            // Mise à jour de la date réel de la fin de mission
            if ($currentMode == 1 && !$detail->reel_end && $detail->mission->details()->count() == $detail->mission->details()->controlled()->count()) {
                $detail->mission->update(['reel_end' => now()]);
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
        $details = $details->get();

        $families = (clone $details)->groupBy('family')->keys();
        $family = getFamilies()->whereIn('name', $families)->get()->map(fn ($item) => ['id' => $item->id, 'label' => $item->name])->toArray();
        $domain = [];
        $process = [];
        $dre = [];
        $agency = [];
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
        return $details;
    }
}
