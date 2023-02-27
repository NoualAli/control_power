<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\Detail\StoreRequest;
use App\Http\Resources\MissionDetailResource;
use App\Models\Agency;
use App\Models\ControlCampaign;
use App\Models\ControlPoint;
use App\Models\Domain;
use App\Models\Familly;
use App\Models\Media;
use App\Models\Mission;
use App\Models\MissionDetail;
use App\Models\Process;
use App\Models\User;
use App\Notifications\MajorFactDetectedNotification;
use App\Traits\UploadFiles;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class MissionDetailController extends Controller
{
    use UploadFiles;

    /**
     * @return Illuminate\Http\JsonResponse
     */
    public function index()
    {
        isAbleOrAbort(['view_mission_detail']);
        $details = $this->getDetails();

        try {
            if (request()->has('campaign_id')) {
                $details = $details->where('control_campaign_id', request()->campaign_id);
            }
            if (request()->has('order')) {
                $details = $details->orderByMultiple(request()->order);
            } else {
                $details = $details->orderBy('created_at', 'DESC');
            }

            $search = request()->has('search') && !empty(request()->search) ? request()->search : false;
            if ($search) {
                $details = $details->search($search);
            }

            $filter = request()->has('filter') ? request()->filter : null;

            if ($filter) {
                $details = $details->filter($filter);
            }

            $details->executed();
            if (request()->has('fetchAll')) {
                $details = $details->get()->pluck('reference', 'id');
            } else {
                $details = MissionDetailResource::collection($details->paginate(10)->onEachSide(1));
            }
            return $details;
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], 500);
        }
    }
    private function getDetails()
    {
        $details = new MissionDetail;

        $user = auth()->user();
        if (hasRole('dcp')) {
            $details = $details->hasCdcrValidation()->majorFacts()->whereAnomaly();
        } elseif (hasRole('cdcr')) {
            $details = $details->dreReportValidated()->majorFacts()->whereAnomaly();
        } elseif (hasRole(['cdc', 'cc', 'ci'])) {
            $details = $user->details();
        } elseif (hasRole(['dg', 'cdrcp', 'der'])) {
            $details = $details->hasDcpValidation()->whereAnomaly();
        } elseif (hasRole('dre')) {
            $details = auth()->user()->details()->hasDcpValidation();
        } elseif (hasRole('da')) {
            $details = $user->details()->hasDcpValidation()->whereAnomaly()->onlyUnregularized();
        }
        return $details;
    }
    /**
     * @return Illuminate\Http\JsonResponse
     */
    public function majorFacts()
    {
        isAbleOrAbort(['view_major_fact']);
        try {

            $details = $this->getMajorFacts();

            if (request()->has('campaign_id')) {
                $details = $details->where('control_campaign_id', request()->campaign_id);
            }
            if (request()->has('order')) {
                $details = $details->orderByMultiple(request()->order);
            } else {
                $details = $details->orderBy('created_at', 'DESC');
            }

            $search = request()->has('search') && !empty(request()->search) ? request()->search : false;
            if ($search) {
                $details = $details->search($search);
            }

            $filter = request()->has('filter') ? request()->filter : null;

            if ($filter) {
                $details = $details->filter($filter);
            }
            $details = $details->onlyMajorFacts();
            if (request()->has('fetchAll')) {
                $details = $details->get()->pluck('reference', 'id');
            } else {
                $details = MissionDetailResource::collection($details->paginate(10)->onEachSide(1));
            }
            return $details;
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], 500);
        }
    }

    private function getMajorFacts()
    {
        $details = MissionDetail::majorFacts();
        if (hasRole(['dcp', 'cdcr'])) {
            $details = $details;
        } elseif (hasRole(['cdc', 'ci', 'cc'])) {
            $details = auth()->user()->details()->majorFacts();
        } elseif (hasRole(['ig', 'dg', 'cdrcp', 'der'])) {
            $details = $details->onlyDispatchedMajorFacts();
        } elseif (hasRole(['da', 'dre'])) {
            $details = auth()->user()->details()->onlyDispatchedMajorFacts();
        }
        return $details;
    }
    /**
     * Enregistre les informations de la mission dans la base de donéees
     *
     * @param StoreRequest $request
     *
     * @return Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $this->validateMetadata($data);
        try {
            DB::transaction(function () use ($data) {
                if (array_key_exists('rows', $data)) {
                    foreach ($data['rows'] as $rowKey => $row) {
                        $this->handleDetail($row, $rowKey);
                    }
                } else {
                    $this->handleDetail($data);
                }
            });
            return response()->json([
                'message' => UPDATE_SUCCESS,
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ]);
        }
    }

    /**
     * Display config.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        isAbleOrAbort(['view_mission', 'control_agency']);
        $detailId = request()->has('detail_id') && !empty(request()->detail_id) && request()->detail_id !== 'null' ? request()->detail_id : false;
        $missionId = request()->has('mission_id') && !empty(request()->mission_id) && request()->mission_id !== 'null' ? request()->mission_id : false;
        $processId = request()->has('process_id') && !empty(request()->process_id) && request()->process_id !== 'null' ? request()->process_id : false;
        // dd($detailId, $missionId, $processId);
        $detail = $detailId ? MissionDetail::findOrFail($detailId)->load(['controlPoint', 'domain', 'process']) : false;
        $mission = $missionId ? Mission::findOrFail($missionId) : $detail->mission;
        $process = $processId ? Process::findOrFail($processId)->load(['familly', 'domain']) : $detail->process->load(['familly', 'domain']);
        if ($detailId) {
            $detail->load('regularization');
            return compact('mission', 'detail', 'process');
        } else {
            $details = $mission->details()->whereRelation('process', 'processes.id', $process->id)->with(['controlPoint', 'domain', 'process'])->get();
            return compact('mission', 'details', 'process');
        }
    }

    private function handleDetail(array $data)
    {
        $processMode = isset($data['process_mode']) ? $data['process_mode'] : false;
        $detail = $this->updateDetail($data, $processMode);
        $this->storeFiles($data, $detail);
        $this->notifyMajorFact($detail);
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
     * @param array $data
     * @param App\Models\MissionDetail $detail
     */
    private function storeFiles(array $data, MissionDetail $detail)
    {
        $files = $data['media'];
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
                    Notification::send($user, new MajorFactDetectedNotification($detail));
                }
            }
        }
    }

    /**
     * Update mission detail
     *
     * @param array $data
     * @param bool $processMode
     *
     * @return App\Models\MissionDetail
     */
    private function updateDetail(array $data, bool $processMode = false)
    {
        $detail = MissionDetail::findOrFail($data['detail']);
        // Vidé les champs report et recovery_plan si la note égale 1
        if ($data['score'] == 1) {
            $data['report'] = null;
            $data['recovery_plan'] = null;
        }

        // Mettre la note max si jamais il y'a un fait majeur
        if ($data['major_fact']) $data['score'] = max(array_keys($detail->controlPoint->scores_arr));
        $processedAt = $processMode ? now() : null;
        // Mise à jour des informations dans la base de données
        $detail->update([
            'major_fact' => $data['major_fact'],
            'score' => $data['score'],
            'report' => $data['report'],
            'recovery_plan' => $data['recovery_plan'],
            'metadata' => !empty($data['metadata']) ? $data['metadata'] : null,
            'executed_at' => now(),
            'processed_at' => $processedAt
        ]);

        return $detail;
    }

    public function filtersData()
    {
        $details = $this->getDetails()->with(['domain', 'process', 'agency', 'mission', 'campaign', 'controlPoint']);
        // $scores = $details->get()->pluck('controlPoint')->map(fn ($controlPoint) => $controlPoint->scores_arr)->toArray();

        // $scores = array_values(array_unique(array_reduce($scores, function ($carry, $item) {
        //     return array_merge($carry, $item);
        // }, [])));
        // $scores = array_map(fn ($value) => ['id' => $value, 'label' => $value], $scores);

        $familliesId = (clone $details)->get()->pluck('familly')->map(fn ($familly) => $familly->id)->unique()->toArray();
        $unformatedFamillies = Familly::whereIn('id', $familliesId);
        $famillies = formatForSelect((clone $unformatedFamillies)->get()->toArray());

        $domainsId = (clone $details)->get()->pluck('domain')->map(fn ($domain) => $domain->id)->unique()->toArray();
        $unformatedDomains = Domain::whereIn('id', $domainsId)->get();
        $domains = formatForSelect($unformatedDomains->toArray());

        $processesId = (clone $details)->get()->pluck('process')->map(fn ($process) => $process->id)->unique()->toArray();
        $unformatedProcesses = Process::whereIn('id', $processesId)->get();
        $processes = formatForSelect($unformatedProcesses->toArray());

        $agenciesId = (clone $details)->get()->pluck('agency')->map(fn ($agency) => $agency->id)->unique()->toArray();
        $unformatedAgencies = Agency::whereIn('id', $agenciesId)->get();
        $agencies = formatForSelect($unformatedAgencies->toArray(), 'full_name');

        $missionsId = (clone $details)->get()->pluck('mission')->map(fn ($mission) => $mission->id)->unique()->toArray();
        $unformatedMissions = Mission::whereIn('id', $missionsId)->get();
        $missions = formatForSelect($unformatedMissions->toArray(), 'reference');

        $campaignsId = (clone $details)->get()->pluck('campaign')->map(fn ($campaign) => $campaign->id)->unique()->toArray();
        $unformatedCampaigns = ControlCampaign::whereIn('id', $campaignsId)->get();
        $campaigns = formatForSelect($unformatedCampaigns->toArray(), 'reference');

        return compact('missions', 'famillies', 'domains', 'processes', 'agencies', 'campaigns');
    }

    public function majorFactsFilterData()
    {
        $details = $this->getMajorFacts()->with(['domain', 'process', 'agency', 'mission', 'campaign']);

        $familliesId = (clone $details)->get()->pluck('familly')->map(fn ($familly) => $familly->id)->unique()->toArray();
        $unformatedFamillies = Familly::whereIn('id', $familliesId);
        $famillies = formatForSelect((clone $unformatedFamillies)->get()->toArray());

        $domainsId = (clone $details)->get()->pluck('domain')->map(fn ($domain) => $domain->id)->unique()->toArray();
        $unformatedDomains = Domain::whereIn('id', $domainsId)->get();
        $domains = formatForSelect($unformatedDomains->toArray());

        $processesId = (clone $details)->get()->pluck('process')->map(fn ($process) => $process->id)->unique()->toArray();
        $unformatedProcesses = Process::whereIn('id', $processesId)->get();
        $processes = formatForSelect($unformatedProcesses->toArray());

        $agenciesId = (clone $details)->get()->pluck('agency')->map(fn ($agency) => $agency->id)->unique()->toArray();
        $unformatedAgencies = Agency::whereIn('id', $agenciesId)->get();
        $agencies = formatForSelect($unformatedAgencies->toArray(), 'full_name');

        $missionsId = (clone $details)->get()->pluck('mission')->map(fn ($mission) => $mission->id)->unique()->toArray();
        $unformatedMissions = Mission::whereIn('id', $missionsId)->get();
        $missions = formatForSelect($unformatedMissions->toArray(), 'reference');

        $campaignsId = (clone $details)->get()->pluck('campaign')->map(fn ($campaign) => $campaign->id)->unique()->toArray();
        $unformatedCampaigns = ControlCampaign::whereIn('id', $campaignsId)->get();
        $campaigns = formatForSelect($unformatedCampaigns->toArray(), 'reference');

        $scores = formatForSelect([['id' => 2, 'name' => '2'], ['id' => 3, 'name' => '3'], ['id' => 4, 'name' => '4']]);

        return compact('missions', 'famillies', 'domains', 'processes', 'scores', 'agencies', 'campaigns');
    }
}