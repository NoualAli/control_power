<?php

namespace App\Http\Controllers\Api;

use App\Events\MissionReportGeneratedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\AssignToCCRequest;
use App\Http\Requests\Mission\StoreRequest;
use App\Http\Requests\Mission\UpdateRequest;
use App\Http\Resources\MissionProcessesResource;
use App\Http\Resources\MissionResource;
use App\Jobs\GenerateMissionReportPdf;
use App\Models\Agency;
use App\Models\ControlCampaign;
use App\Models\Mission;
use App\Models\Process;
use App\Models\User;
use App\Notifications\Mission\AssignationRemoved;
use App\Notifications\Mission\Assigned;
use App\Notifications\Mission\Updated;
use App\Notifications\Mission\Validated;
use App\Notifications\ReportNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\PendingDispatch;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        isAbleOrAbort(['view_mission']);
        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request('fetchAll', false);

        try {
            $missions = $this->getMissions();

            $campaignId = request('campaign_id', null);
            $campaignId = request('campaignId', $campaignId);
            if ($campaignId) {
                $missions = $missions->where('control_campaign_id', $campaignId);
            }
            if ($fetchFilters) {
                return $this->getFilters($missions);
            }

            if ($sort) {
                $missions = $missions->sortByMultiple($sort);
            } else {
                $missions = $missions->orderBy('created_at', 'DESC');
            }

            if ($search) {
                $missions = $missions->search($search);
            }

            if ($filter) {
                $missions = $missions->filter($filter);
            }

            if ($fetchAll) {
                $missions = formatForSelect($missions->get()->toArray(), 'reference');
            } else {
                $missions = MissionResource::collection($missions->paginate($perPage)->onEachSide(1));
            }
            return $missions;
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function show(Mission $mission)
    {
        isAbleOrAbort('view_mission');
        $currentUser = auth()->user();
        // $missions = $currentUser->missions()?->pluck('id')->toArray() ?: [];
        // // dd(in_array($mission->id, $missions));
        // // dd($missions);
        $dreControllers = $mission->dreControllers->pluck('id')->toArray();
        $dcpControllers = $mission->dcpControllers->pluck('id')->toArray();
        $agencies = $currentUser->agencies->pluck('id')->toArray();

        $condition = (in_array($currentUser->id, $dreControllers)
            || in_array($currentUser->id, $dcpControllers)
            || $mission->created_by_id == $currentUser->id
            || (hasRole(['dcp']) && $mission->is_validated_by_cdcr)
            || (hasRole(['cdcr']) && $mission->is_validated_by_cdc)
            || (hasRole(['dg', 'cdrcp', 'ig', 'der', 'sg']) && $mission->is_validated_by_dcp)
            || (hasRole(['dre', 'da']) && in_array($mission->agency->id, $agencies) && $mission->is_validated_by_dcp)
        );
        abort_if(!$condition, 401, __('unauthorized'));
        if (!isAbleTo('view_opinion')) {
            $mission->makeHidden('opinion');
        }
        if (request()->has('edit')) {
            $condition = $mission->remaining_days_before_start > 5;
            abort_if(!$condition, 401, __('unauthorized'));
        }

        if (!hasRole('cdc')) {
            $mission->makeHidden('ci_report');
        }

        $mission = $mission->load([
            'agency',
            'dre',
            'dreControllers',
            'dcpControllers',
            'ciValidator',
            'cdcValidator',
            'ccValidator',
            'cdcrValidator',
            'dcpValidator',
            'daRegularizator',
            'campaign' => fn ($campaign) => $campaign->select('reference', 'id')->without('processes')
        ])->unsetRelation('details');
        $mission->makeHidden(['dcp_validation_by_id', 'cdcr_validation_by_id', 'cdc_validation_by_id', 'ci_validation_by_id', 'cc_validation_by_id', 'agency_id', 'control_campaign_id', 'created_by_id']);

        return $mission;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['created_by_id'] = auth()->user()->id;
        try {
            $campaign = ControlCampaign::findOrFail($data['control_campaign_id']);
            $campaign->load('processes');
            $agency = $data['agency'];
            $agency = Agency::findOrFail($agency);
            DB::transaction(function () use ($data, $agency, $campaign) {
                $reference = 'RAP' . str_replace('-', '', str_replace('CDC-', '', $campaign->reference)) . '/' . $agency->code;
                $controlPoints = $this->loadControlPoints($campaign, $agency);
                $mission = Mission::create([
                    'reference' => $reference,
                    'control_campaign_id' => $campaign->id,
                    'agency_id' => $agency->id,
                    'created_by_id' => auth()->user()->id,
                    'programmed_start' => $data['programmed_start'],
                    'programmed_end' => $data['programmed_end'],
                    'note' => $data['note'],
                ]);
                $mission->dreControllers()->attach($data['controllers']);
                $mission->details()->createMany($controlPoints);
                foreach ($mission->dreControllers as $controller) {
                    Notification::send($controller, new Assigned($mission));
                }
            });

            return response()->json([
                'message' => 'Mission répartie avec succès',
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            $status = false;
            return response()->json(compact('message', 'status'));
        }
    }

    /**
     * Update the specified resource in storage
     *
     * @param UpdateRequest $request
     * @param Mission $mission
     *
     * @return Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Mission $mission)
    {
        $data = $request->validated();
        try {
            DB::transaction(function () use ($mission, $data) {
                $mission->dreControllers()->sync($data['controllers']);
                $mission->update([
                    'programmed_start' => $data['programmed_start'],
                    'programmed_end' => $data['programmed_end'],
                    'note' => $data['note'],
                ]);
                $users = $mission->dreControllers();
                if (auth()->user()->id) {
                }
                foreach ($users->get() as $user) {
                    Notification::send($user, new Updated($mission));
                }
            });

            return response()->json([
                'message' => 'Informations de la mission mis à jour avec succès',
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            $status = false;
            return response()->json(compact('message', 'status'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mission $mission)
    {
        isAbleOrAbort('delete_mission');
        try {
            if ($mission->delete()) {
                return response()->json([
                    'message' => 'Mission supprimer avec succès',
                    'status' => true,
                ]);
            }
            return response()->json([
                'message' => DELETE_ERROR,
                'status' => false,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false,
            ]);
        }
    }

    public function details(Mission $mission, Process $process)
    {
        isAbleOrAbort(['view_mission', 'control_agency']);
        $currentUser = auth()->user();

        $dreControllers = $mission->dreControllers->pluck('id')->toArray();
        $dcpControllers = $mission->dcpControllers->pluck('id')->toArray();
        $agencies = $currentUser->agencies->pluck('id')->toArray();

        $condition = (in_array($currentUser->id, $dreControllers)
            || in_array($currentUser->id, $dcpControllers)
            || $mission->created_by_id == $currentUser->id
            || (hasRole(['dcp']) && $mission->is_validated_by_cdcr)
            || (hasRole(['cdcr']) && $mission->is_validated_by_cdc)
            || (hasRole(['dg', 'cdrcp', 'ig', 'der', 'sg']) && $mission->is_validated_by_dcp)
            || (hasRole(['dre', 'da']) && in_array($mission->agency->id, $agencies) && $mission->is_validated_by_dcp)
        );
        abort_if(!$condition, 401, __('unauthorized'));
        $details = $mission->details()->with('controlPoint')->orderBy('control_point_id');
        $mission->unsetRelations();
        $process->load(['family', 'domain', 'media']);
        if (request()->has('onlyAnomaly')) {
            $details = $details->whereAnomaly();
        }
        $details = $details->whereRelation('process', 'processes.id', $process->id);

        $details = $details->get();
        $mode = false;
        if (hasRole(['ci'])) {
            $mode = 1; // Execution mode
        } elseif (hasRole('cdc')) {
            $mode = 2; // Revision mode
        } elseif (hasRole('cc')) {
            $mode = 3; // First processing mode
        } elseif (hasRole('cdcr')) {
            $mode = 4; // Second processing mode
        } elseif (hasRole('dcp')) {
            $mode = 5; // Third processing mode
        } else {
            $mode = 6; // Readonly mode
        }
        return compact('mission', 'details', 'process', 'mode');
    }

    /**
     * Validate mission
     *
     * @param Mission $mission
     * @param string $step
     *
     * @return Illuminate\Http\Response
     */
    public function validateMission(Mission $mission, string $type)
    {
        try {
            $attributes = $this->validationAttributes($mission, $type);
            abort_if(!$attributes['isAbleOrAbort'], 500);

            return DB::transaction(function () use ($mission, $attributes, $type) {
                $mission->update([
                    $attributes['validationAtColumn'] => now(),
                    $attributes['validationByColumn'] => auth()->user()->id,
                ]);
                if ($attributes['notify'] instanceof Collection) {
                    foreach ($attributes['notify'] as $user) {
                        Notification::send($user, new Validated($mission, $type));
                    }
                } else {
                    Notification::send($attributes['notify'], new Validated($mission, $type));
                }
                return response()->json([
                    'message' => MISSION_VALIDATION_SUCCESS,
                    'status' => true,
                ]);
            });
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            $status = false;
            return compact('message', 'status');
        }
    }
    /**
     * Prepare database attribute and ACLs for validation
     *
     * @param App\Models\Mission $mission
     * @param string $type
     * @return Collection
     **/
    public function validationAttributes(Mission $mission, string $type)
    {

        switch ($type) {
            case 'ci_report':
                $validationAtColumn = 'ci_validation_at';
                $validationByColumn = 'ci_validation_by_id';
                $isAbleOrAbort = hasRole('ci') && $mission->dreControllers->contains('id', auth()->user()->id);
                $notify = $mission->creator;
                break;
            case 'cdc_report':
                $validationAtColumn = 'cdc_validation_at';
                $validationByColumn = 'cdc_validation_by_id';
                $isAbleOrAbort = hasRole('cdc') && $mission->created_by_id == auth()->user()->id;
                $notify = User::whereRoles(['cdcr'])->get();
                break;
            case 'cdcr':
                $validationAtColumn = 'cdcr_validation_at';
                $validationByColumn = 'cdcr_validation_by_id';
                $isAbleOrAbort = hasRole('cdcr');
                $notify = User::whereRoles(['dcp'])->get();
                break;
            case 'cc':
                $validationAtColumn = 'cc_validation_at';
                $validationByColumn = 'cc_validation_by_id';
                $isAbleOrAbort = hasRole('cc') && $mission->dcpControllers->contains('id', auth()->user()->id);
                $notify = User::whereRoles(['cdcr'])->get();
                break;
            case 'dcp':
                $validationAtColumn = 'dcp_validation_at';
                $validationByColumn = 'dcp_validation_by_id';
                $isAbleOrAbort = hasRole('dcp');
                $notify = User::whereRoles(['cdcr', 'dg', 'cdrcp', 'ig', 'sg', 'der']);
                $notify = User::whereRoles(['da', 'dre'])->whereRelation('agencies', 'agencies.id', $mission->agency_id)->get()->merge($notify->get());
                break;
            case 'da':
                $validationAtColumn = 'da_validation_at';
                $validationByColumn = 'da_validation_by_id';
                $isAbleOrAbort = hasRole('da') && auth()->user()->hasAgencies($mission->agency_id) && isAbleTo('regularize_mission_detail');
                $notify = User::whereRoles(['cdcr', 'dg', 'cdrcp', 'ig', 'sg', 'der']);
                $notify = User::whereRoles(['dre'])->whereRelation('agencies', 'agencies.id', $mission->agency_id)->get()->merge($notify->get());
                $notify = $notify->merge($mission->dcpControllers)->merge($mission->dreControllers);
                break;
            default:
                $validationAtColumn = 'ci_validation_at';
                $validationByColumn = 'ci_validation_by_id';
                $isAbleOrAbort = hasRole('ci') && $mission->dreControllers->contains('id', auth()->user()->id);
                $notify = $mission->creator;
                break;
        }

        return compact('validationAtColumn', 'validationByColumn', 'isAbleOrAbort', 'notify');
    }

    /**
     * Handle mission report action [Export, Generate]
     *
     * @param Mission $mission
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Illuminate\Foundation\Bus\PendingDispatch
     */
    public function handleReport(Mission $mission)
    {
        $fileExists = Storage::exists($mission->report_path);
        if (request()->action == 'generate' && !$fileExists) {
            if (!Session::has('mission_report_generated_' . $mission->reference)) {
                session()->put('mission_report_generated_' . $mission->reference, 'mission_report_generated_' . $mission->reference);
                $this->generateReport($mission);
            } else {
                return $this->exportReport($mission);
            }
        } elseif (request()->action == 'export' && $fileExists) {
            return $this->exportReport($mission);
        } else {
            return response()->json(['error' => "L'action que vous avez choisit n'existe pas."], 404);
        }
    }

    public function missionReportIsGenerated(Mission $mission)
    {
        return response()->json((bool) Session::has('mission_report_generated_' . $mission->reference) || $mission->pdf_report_exists);
    }

    /**
     * Export mission report
     *
     * @param Mission $mission
     *
     * @return \Illuminate\Http\Response
     */
    private function exportReport(Mission $mission)
    {
        $filename = $mission->report_path;
        $file = Storage::get($filename);
        // Determine the MIME type
        $mime = Storage::mimeType($filename);
        // Create a response with the file contents and appropriate headers
        $response = response($file, 200)->header('Content-Type', $mime);

        return $response;
    }

    /**
     * Generate mission report
     *
     * @param Mission $mission
     *
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     */
    private function generateReport(Mission $mission)
    {
        // $metadata = $mission->details()->whereNotNull('metadata')->first()->metadata;
        // if ($metadata) {
        //     echo '<div class="page-break-after-always"></div>';
        //     echo '<tr>';
        //     echo '<td colspan="4" class="text-center bg-gray">';
        //     echo '<b>Constats liés à l\'échantillonage</b>';
        //     echo '</td>';
        //     echo '</tr>';

        //     foreach ($metadata as $item) {
        //         $currentIndex = 1;

        //         foreach ($item as $parsed) {
        //             $parsed = json_decode(json_encode($parsed), true);
        //             $keys = array_keys($parsed);
        //             $count = count($item);
        //             // dd($parsed[$keys[1]], $keys[1]);
        //             echo '<tr class="metadata-row ' . ($currentIndex == $count ? 'border-bottom' : null) . '">';
        //             echo '<th class="margin-cell"></th>';
        //             echo '<th>' . $parsed[$keys[0]] . '</th>';
        //             echo '<td>' . $parsed[$keys[1]] . '</td>';
        //             echo '<th class="margin-cell"></th>';
        //             echo '</tr>';

        //             $currentIndex += 1;
        //         }
        //     }
        // }
        return GenerateMissionReportPdf::dispatch($mission);
    }

    /**
     * Fetch missions filters
     *
     * @param Illuminate\Database\Eloquent\Builder|null $missions
     *
     * @return array
     */
    public function getFilters(Builder $missions = null)
    {
        $missions = $missions ?? $this->getMissions();
        $dre_controllers = $missions->relationUniqueData('dreControllers', 'full_name', 'id');
        $dre = $missions->relationUniqueData('dre', 'name', 'id', 'full_name');
        $agency = $missions->relationUniqueData('agency', 'name', 'id', 'full_name');
        $campaign = $missions->relationUniqueData('campaign', 'reference');
        return compact('dre', 'agency', 'campaign', 'dre_controllers');
    }

    /**
     * Fetch mission processes
     *
     * @param Mission $mission
     *
     * @return Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function processes(Mission $mission)
    {
        $processes = $this->loadProcesses($mission);
        $fetchFilters = request()->has('fetchFilters');
        if ($fetchFilters) {
            return $this->loadFilters($processes);
        }
        $processes = $this->filterData($processes);
        $perPage = request('perPage', 10);

        return MissionProcessesResource::collection(paginate($processes, '/api/missions/' . $mission->id, $perPage));
    }

    /**
     * Display config.
     *
     * @return \Illuminate\Http\Response
     */
    public function config()
    {
        isAbleOrAbort(['create_missions', 'edit_mission']);
        $agencies = [];
        $controllers = [];

        abort_if(!ControlCampaign::count(), 423, 'Aucune campagne de contrôle n\'existe encore');
        $currentCampaign = ControlCampaign::current();
        abort_if(!$currentCampaign->validated_by_id, 403);
        $campaigns = formatForSelect(ControlCampaign::validated()->orderBy('reference', 'DESC')->get()->toArray(), 'reference');
        if (request()->has('campaign_id')) {
            $user = auth()->user();
            $currentCampaign = ControlCampaign::findOrFail(request()->campaign_id)->load(['missions']);
            $missions = $currentCampaign?->missions;
            $agencies = $user->agencies()->with('users')->get();

            $controllers = (clone $agencies)->pluck('users')->flatten()->filter(function ($user) use ($missions) {
                return $user->isAbleTo('control_agency') && $user->id !== auth()->user()->id;
            })->unique('id')->flatten()->toArray();
            $controllers = formatForSelect($controllers, 'full_name');

            $agencies = formatForSelect(($user->dres)->pluck('agencies')->flatten()->filter(function ($agency) use ($missions) {
                return !in_array($agency?->id, $missions->pluck('agency')->flatten()->pluck('id')->toArray());
            })->flatten()->toArray(), 'full_name');
        }
        return compact('agencies', 'campaigns', 'controllers', 'currentCampaign');
    }

    /**
     * Assign mission to CC
     *
     * @param AssignToCCRequest $request
     * @param Mission $mission
     *
     * @return Illuminate\Http\Response
     */
    public function assignToCC(AssignToCCRequest $request, Mission $mission)
    {
        try {
            DB::transaction(function () use ($request, $mission) {
                $mission->load('dcpControllers');
                $existingControllers = $mission->dcpControllers;
                $mission->dcpControllers()->syncWithPivotValues($request->controllers, ['control_agency' => false]);
                $updatedControllers = $mission->dcpControllers()->get();

                // Notify added controllers
                foreach ($updatedControllers as $controller) {
                    if (!in_array($controller->id, $existingControllers->pluck('id')->toArray())) {
                        Notification::send($controller, new Assigned($mission));
                    }
                }

                // Notify removed controllers
                $removedControllers = array_diff($existingControllers->pluck('id')->toArray(), $updatedControllers->pluck('id')->toArray());
                $removedControllers = User::whereIn('id', $removedControllers)->get();
                foreach ($removedControllers as $controller) {
                    Notification::send($controller, new AssignationRemoved($mission));
                }
            });
            return response()->json([
                'message' => UPDATE_SUCCESS,
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    private function loadAgencies(ControlCampaign $campaign)
    {
        // TODO
    }

    /**
     * Load all usable control points for specific agency
     *
     * @param ControlCampaign $campaign
     * @param Agency $agency
     *
     * @return array
     */
    private function loadControlPoints(ControlCampaign $campaign, Agency $agency): array
    {
        $agency->load(['unusableProcesses', 'usableProcesses']);

        $campaignProcesses = $campaign->processes;
        $categoryProcesses = [];
        if ($campaignProcesses->count()) {
            $categoryProcesses = $agency->category->processes;
            $exceptionalUsableAgencyProcesses = $agency->usableProcesses;
            $exceptionalUnusableAgencyProcesses = $agency->unusableProcesses->pluck('id')->toArray();

            $categoryProcesses = $categoryProcesses->merge($exceptionalUsableAgencyProcesses)->unique('id'); // Ajout des processus exceptionelles

            $categoryProcesses = $categoryProcesses->filter(function ($process) use ($exceptionalUnusableAgencyProcesses) {
                return !in_array($process->id, $exceptionalUnusableAgencyProcesses); // suppression des processus exceptionelles
            });

            $categoryProcesses = $categoryProcesses->pluck('id')->toArray();
        }
        return $campaignProcesses->filter(function ($process) use ($categoryProcesses) {
            return in_array($process->id, $categoryProcesses); // garder que les processus utilisés par la catégorie
        })->pluck('control_points')->flatten()->pluck('id')->map(fn ($controlPoint) => ['control_point_id' => $controlPoint])->toArray();
    }

    /**
     * Load processes
     *
     * @param Mission $mission
     * @param bool $paginated
     * @param bool $formated
     * @param bool $onlyWhereAnomaly
     *
     * @return Illuminate\Support\Collection
     */
    private function loadProcesses(Mission $mission, bool $paginated = false, bool $formated = false, bool $onlyWhereAnomaly = false)
    {
        $mission->unsetRelations();
        $processes = getMissionProcesses($mission);
        $processes = !hasRole(['cdc', 'ci']) && $onlyWhereAnomaly ? $processes->whereIn('md.score', [2, 3, 4]) : $processes;
        $search = request('search', false);
        $sort = request('sort', false);

        if ($sort) {
            foreach ($sort as $key => $value) {
                $processes = $processes->orderBy($key, $value);
            }
        } else {
            $processes = $processes->orderBy('f.id')->orderBy('p.id');
        }
        $processes = $processes->get();
        if ($search) {
            $processes = $processes->filter(fn ($processe) => preg_match('/' . strtolower($search) . '/', strtolower($processe->process)));
        }
        if ($formated) {
            $processes = formatForSelect($processes->toArray());
        }
        return $processes;
    }

    /**
     * Load filters data
     *
     * @param mixed $data
     *
     * @return Array
     */
    private function loadFilters($data)
    {
        $family = formatForSelect((clone $data)->uniqueStrict('family')->map(fn ($item) => (array) $item)->toArray(), 'family', 'family');
        $domain = formatForSelect((clone $data)->uniqueStrict('domain')->map(fn ($item) => (array) $item)->toArray(), 'domain', 'domain');

        return  compact('family', 'domain');
    }

    /**
     * Filter data
     *
     * @param mixed $data
     *
     * @return Illuminate\Support\Collection
     */
    private function filterData($data)
    {
        if (request()->has('filter') && !empty(request()->filter)) {
            foreach (request()->filter as $key => $value) {
                if (!empty($value)) {
                    $values = explode(',', $value);
                    if (!empty($values)) {
                        $data = $data->whereIn($key, $values);
                    }
                }
            }
        }

        if (request()->has('search') && !empty(request()->search)) {
            $data = $data->filter(fn ($process) => preg_match('/' . strtolower(request()->search) . '/', strtolower($process->process)));
        }

        return $data;
    }

    /**
     * Fetch user mission
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function getMissions()
    {
        $missions = new Mission();
        if (hasRole(['dcp', 'cdcr', 'dg', 'cdrcp', 'der', 'sg'])) {
            $missions = $missions;
        } elseif (hasRole(['cdc', 'cc', 'ci', 'dre', 'da'])) {
            $missions = auth()->user()->missions();
        }
        // elseif (hasRole(['cdrcp', 'der'])) {
        //     $missions = $missions->hasDcpValidation();
        // }
        // elseif (hasRole(['da', 'dre'])) {
        //     $missions = auth()->user()->missions()->hasDcpValidation();
        // }
        return $missions;
    }
}
