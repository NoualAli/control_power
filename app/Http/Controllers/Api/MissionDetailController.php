<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\Detail\StoreRequest;
use App\Http\Resources\MissionDetailResource;
use App\Models\Agency;
use App\Models\ControlCampaign;
use App\Models\Domain;
use App\Models\Familly;
use App\Models\Media;
use App\Models\Mission;
use App\Models\MissionDetail;
use App\Models\Process;
use App\Models\User;
use App\Notifications\Mission\MajorFact\Detected;
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
            $details = $details->dreReportValidated();
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
        return $details->whereAnomaly()->where('major_fact', '!=', true)->executed()->with(['process', 'domain', 'controlPoint', 'familly', 'media']);
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
        $details = new MissionDetail;
        if (hasRole(['dcp', 'cdcr'])) {
            $details = $details;
        } elseif (hasRole(['cdc', 'ci', 'cc'])) {
            $details = auth()->user()->details()->executed();
        } elseif (hasRole(['ig', 'dg', 'cdrcp', 'der'])) {
            $details = $details->onlyDispatchedMajorFacts();
        } elseif (hasRole(['da', 'dre'])) {
            $details = auth()->user()->details()->onlyDispatchedMajorFacts();
        }
        return $details->onlyMajorFacts();
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

        $detail = $detailId ? MissionDetail::findOrFail($detailId)->load(['controlPoint', 'domain', 'process']) : false;
        $mission = $missionId ? Mission::findOrFail($missionId) : $detail->mission;
        $process = $processId ? Process::findOrFail($processId)->load(['familly', 'domain']) : $detail->process->load(['familly', 'domain']);

        $currentUser = auth()->user();
        $agencyControllers = $mission->agencyControllers->pluck('id')->toArray();
        $dcpControllers = $mission->dcpControllers->pluck('id')->toArray();
        $agencies = $currentUser->agencies->pluck('id')->toArray();

        $condition = (in_array($currentUser->id, $agencyControllers)
            || in_array($currentUser->id, $dcpControllers)
            || $mission->created_by_id == $currentUser->id
            || (hasRole(['dcp', 'cdcr']) && $mission->dre_report?->is_validated)
            || (hasRole(['da', 'dg', 'cdrcp', 'ig', 'der']) && $mission->dcp_validation_at)
            || hasRole('dre') && in_array($mission->agency->id, $agencies)
            || hasRole(['dcp', 'cdcr']) && $detail->major_fact
        );
        abort_if(!$condition, 401, __('unauthorized'));
        if ($detailId) {
            $detail->load('regularization', 'mission');
            $mission->load(['dre', 'agency', 'campaign']);
            return compact('mission', 'detail', 'process');
        } else {
            $details = $mission->details()->orderBy('control_point_id');
            if (request()->has('onlyAnomaly')) {
                $details = $details->whereAnomaly();
            }
            $details = $details->whereRelation('process', 'processes.id', $process->id);
            // if ($mission->progress_status == 100) {
            //     $details = $details;
            // }
            $details = $details->with(['controlPoint', 'domain', 'process', 'regularization'])->get();
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
        $files = !isset($data['media']) ?: $data['media'];
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
     * @param bool $processMode
     *
     * @return App\Models\MissionDetail
     */
    private function updateDetail(array $data, bool $processMode = false)
    {
        $detail = MissionDetail::findOrFail($data['detail']);
        // Vidé les champs report, recovery_plan, metadata
        if (isset($data['score']) && !in_array($data['score'], [4, 3, 2, 1])) {
            $data['report'] = null;
            $data['recovery_plan'] = null;
            $data['metadata'] = null;
        }
        // Mettre la note max si jamais il y'a un fait majeur
        if (isset($data['major_fact']) && !empty($data['major_fact'])) $data['score'] = max(array_keys($detail->controlPoint->scores_arr));
        $processedAt = $processMode ? now() : null;
        $executedAt = now();

        // Mise à jour des informations dans la base de données
        $metadata = isset($data['metadata']) && !empty($data['metadata']) ? $data['metadata'] : $detail->metadata;
        $detail->update([
            'major_fact' => $data['major_fact'],
            'score' => isset($data['score']) ? $data['score'] : $detail->score,
            'report' => isset($data['report']) ? $data['report'] : $detail->report,
            'recovery_plan' => isset($data['recovery_plan']) ? $data['recovery_plan'] : $detail->recovery_plan,
            'metadata' => $metadata,
            'executed_at' => $executedAt,
            'processed_at' => $processedAt
        ]);
        if ($processMode) {
            if ($detail->mission->realisation_state !== 'En cours de validation') {
                $detail->mission->states()->create(['state' => 'En cours de validation']);
            }
        } else {
            if ($detail->mission->realisation_state !== 'En cours') {
                $detail->mission->states()->create(['state' => 'En cours']);
            }
        }
        return $detail;
    }

    public function filtersData()
    {
        $details = $this->getDetails();
        $famillies = $details->relationUniqueData('familly');
        $domains = $details->relationUniqueData('domain');
        $processes = $details->relationUniqueData('process');
        $dres = $details->relationUniqueData('dre', 'full_name');
        $agencies = $details->relationUniqueData('agency', 'full_name');
        $missions = $details->relationUniqueData('mission', 'reference');
        $campaigns = $details->relationUniqueData('campaign', 'reference');
        return compact('missions', 'famillies', 'domains', 'processes', 'agencies', 'campaigns', 'dres');
    }

    public function majorFactsFilterData()
    {
        // $details = $this->getMajorFacts()->with(['domain', 'process', 'agency', 'mission', 'campaign']);

        // $familliesId = (clone $details)->get()->pluck('familly')->map(fn ($familly) => $familly->id)->unique()->toArray();
        // $unformatedFamillies = Familly::whereIn('id', $familliesId);
        // $famillies = formatForSelect((clone $unformatedFamillies)->get()->toArray());

        // $domainsId = (clone $details)->get()->pluck('domain')->map(fn ($domain) => $domain->id)->unique()->toArray();
        // $unformatedDomains = Domain::whereIn('id', $domainsId)->get();
        // $domains = formatForSelect($unformatedDomains->toArray());

        // $processesId = (clone $details)->get()->pluck('process')->map(fn ($process) => $process->id)->unique()->toArray();
        // $unformatedProcesses = Process::whereIn('id', $processesId)->get();
        // $processes = formatForSelect($unformatedProcesses->toArray());

        // $agenciesId = (clone $details)->get()->pluck('agency')->map(fn ($agency) => $agency->id)->unique()->toArray();
        // $unformatedAgencies = Agency::whereIn('id', $agenciesId)->get();
        // $agencies = formatForSelect($unformatedAgencies->toArray(), 'full_name');

        // $missionsId = (clone $details)->get()->pluck('mission')->map(fn ($mission) => $mission->id)->unique()->toArray();
        // $unformatedMissions = Mission::whereIn('id', $missionsId)->get();
        // $missions = formatForSelect($unformatedMissions->toArray(), 'reference');

        // $campaignsId = (clone $details)->get()->pluck('campaign')->map(fn ($campaign) => $campaign->id)->unique()->toArray();
        // $unformatedCampaigns = ControlCampaign::whereIn('id', $campaignsId)->get();
        // $campaigns = formatForSelect($unformatedCampaigns->toArray(), 'reference');

        // $scores = formatForSelect([['id' => 2, 'name' => '2'], ['id' => 3, 'name' => '3'], ['id' => 4, 'name' => '4']]);

        // return compact('missions', 'famillies', 'domains', 'processes', 'scores', 'agencies', 'campaigns');
        $famillies = formatForSelect(Familly::all()->pluck('name', 'id')->toArray());
        $domains = formatForSelect(Domain::all()->pluck('name', 'id')->toArray());
        $processes = formatForSelect(Process::all()->pluck('name', 'id')->toArray());
        $agencies = formatForSelect(Agency::all()->pluck('full_name', 'id')->toArray());
        $missions = !hasRole(['cc', 'cdc', 'ci']) ? formatForSelect(Mission::all()->pluck('refernce', 'id')->toArray(), 'reference') : formatForSelect(auth()->user()->missions->toArray(), 'reference');
        $campaigns = !hasRole(['cc', 'ci']) ? formatForSelect(ControlCampaign::all()->pluck('reference', 'id')->toArray(), 'reference') : formatForSelect(auth()->user()->campaigns->toArray(), 'reference');
        return compact('missions', 'famillies', 'domains', 'processes', 'agencies', 'campaigns');
    }
}
