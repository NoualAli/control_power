<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\GeneralReportRequest;
use App\Http\Requests\Mission\ReportRequest;
use App\Http\Requests\Mission\StoreRequest;
use App\Http\Requests\Mission\ValidateRequest;
use App\Http\Requests\Sample\ValidateSample;
use App\Http\Resources\DetailsResource;
use App\Http\Resources\MissionResource;
use App\Http\Resources\PlanningResource;
use App\Http\Resources\SampleResource;
use App\Models\Agency;
use App\Models\ControlCampaign;
use App\Models\DetailPoint;
use App\Models\Mission;
use App\Models\Sample;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;

class MissionController extends Controller
{
    public function details()
    {
        $details = hasRole(['dcp', 'dg']) ? new  DetailPoint :  auth()->user()->details();

        $sortArray = request()->has('order') ?? request()->order;

        if ($sortArray) {
            $details = $details->orderByMultiple($sortArray);
        }

        if (request()->has('search') && !empty(request()->search)) {
            $searchables = ['mission.reference'];
            $i = 0;
            foreach ($searchables as $column) {
                $clause = $i ? 'orWhere' : 'where';
                $columns = explode('.', $column);
                if (count($columns)) {
                    $clause = $i ? 'orWhereRelation' : 'whereRelation';
                    $details = $details->$clause($columns[0], $columns[1], 'LIKE', "%" . request()->search . "%");
                } else {
                    $details = $details->$clause($column, 'LIKE', "%" . request()->search . "%");
                }
                $i += 1;
            }
        }

        $filter = request()->has('filter') ? request()->filter : null;
        if ($filter) {
            $details = $details->filter($filter);
        }
        $details = request()->has('fetchAll') && !$filter ? $details->get()->pluck('reference', 'id')->toArray() : DetailsResource::collection($details->paginate()->onEachSide(1));
        return $details;
    }

    public function global()
    {
        if (hasRole(['dcp', 'dg'])) {
            $missions = Mission::validated();
        } elseif (hasRole('ci')) {
            $missions = auth()->user()->missions();
        } elseif (hasRole('cdc')) {
            $agencies = Agency::where('dre_id', auth()->user()->dre->id)->pluck('agencies.id')->toArray();
            $missions = Mission::whereIn('agency_id', $agencies);
        }

        if (request()->has('order')) {
            foreach (request()->order as $key => $value) {
                $missions = $missions->orderBy($key, $value);
            }
        }
        if (request()->has('search') && !empty(request()->search)) {
            $searchables = ['reference'];
            $i = 0;
            foreach ($searchables as $column) {
                $clause = $i ? 'orWhere' : 'where';
                $missions = $missions->$clause($column, 'LIKE', "%" . request()->search . "%");
                $i += 1;
            }
        }
        $missions = request()->has('fetchAll') ? $missions->get()->pluck('reference', 'id')->toArray() : MissionResource::collection($missions->paginate()->onEachSide(1));
        return $missions;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campaign = ControlCampaign::findOrFail($request->control_campaign_id);
        $agency = Agency::findOrFail($request->agency_id);
        $processes = $campaign->processes;
        $data = $request->all();
        $data['created_by_id'] = auth()->user()->id;
        $data['reference'] = 'RAP' . str_replace('-', '', str_replace('CDC-', '', $campaign->reference)) . '/' . $agency->code;

        $data = Validator::make($data, (new StoreRequest())->rules())->validate();

        try {
            $mission = Mission::create([
                'reference' => $data['reference'],
                'control_campaign_id' => $campaign->id,
                'agency_id' => $agency->id,
                'created_by_id' => auth()->user()->id,
                'start' => $data['start'],
                'end' => $data['end'],
                'note' => $data['note'],
                'controller_id' => $data['controller_id']
            ]);
            foreach ($processes as $process) {
                $mission->samples()->create([
                    'agency_id' => $agency->id,
                    'created_by_id' => $data['controller_id'],
                    'process_id' => $process->id,
                    'total_folders' => !$process->pivot->sampling,
                    'total_samples' => !$process->pivot->sampling
                ]);
            }
            $message = $mission->exists ? "La mission a été configurer avec succès" : "Une erreur est survenue lors de la tentative de création de la mission";
            $status = $mission->exists;

            return response()->json(compact('message', 'status'));
        } catch (\Throwable $th) {
            $message = "Une erreur est survenue lors de la tentative de création de la mission";
            if (env('APP_DEBUG')) {
                $message = $th->getMessage();
            }
            $status = false;
            return response()->json(compact('message', 'status'));
        }
    }

    /**
     * Display a listing of the resource (not validated).
     */
    public function notValidated()
    {
        if (hasRole('ci')) {
            $missions = auth()->user()->missions()->notValidated();
        } elseif (hasRole('cdc')) {
            $agencies = Agency::where('dre_id', auth()->user()->dre->id)->pluck('agencies.id')->toArray();
            $missions = Mission::whereIn('agency_id', $agencies)->notValidated();
        }

        if (request()->has('order')) {
            foreach (request()->order as $key => $value) {
                $missions = $missions->orderBy($key, $value);
            }
        } else {
            $missions = $missions->orderBy('created_at', 'DESC');
        }
        $search = request()->has('search') && !empty(request()->search) ?? request()->search;
        if ($search) {
            $missions = $missions->search($search);
        }

        $missions = request()->has('fetchAll') ? $missions->get()->pluck('reference', 'id')->toArray() : MissionResource::collection($missions->paginate()->onEachSide(1));
        return $missions;
    }

    /**
     * Display a listing of the resource (validated).
     */
    public function confirmed()
    {
        if (hasRole(['dcp', 'dg'])) {
            $missions = Mission::validated();
        } elseif (hasRole('ci')) {
            $missions = auth()->user()->missions()->validated();
        } elseif (hasRole('cdc')) {
            $agencies = Agency::where('dre_id', auth()->user()->dre->id)->pluck('agencies.id')->toArray();
            $missions = Mission::whereIn('agency_id', $agencies)->validated();
        }

        if (request()->has('order')) {
            foreach (request()->order as $key => $value) {
                $missions = $missions->orderBy($key, $value);
            }
        } else {
            $missions = $missions->orderBy('validated_at', 'DESC');
        }
        $search = request()->has('search') && !empty(request()->search) ?? request()->search;
        if ($search) {
            $missions = $missions->search($search);
        }
        $missions = request()->has('fetchAll') ? $missions->get()->pluck('reference', 'id')->toArray() : MissionResource::collection($missions->paginate()->onEachSide(1));
        return $missions;
    }

    public function index()
    {
        $fetchAll = request()->has('fetchAll');
        $asPlanning = request()->has('asPlanning');
        $search = request()->has('search') ? request()->search : null;
        $order = request()->has('order') ?? request()->order;
        $state = request()->has('state') ? request()->state : false;

        if (hasRole(['dcp', 'dg'])) {
            $missions = new Mission;
        } elseif (hasRole('ci')) {
            $missions = auth()->user()->missions();
        } elseif (hasRole('cdc')) {
            $missions = Mission::whereIn('agency_id', auth()->user()->dre->agencies->pluck('id'));
        }

        if ($order) {
            foreach (request()->order as $key => $value) {
                $missions = $missions->orderBy($key, $value);
            }
        } else {
            $missions = $missions->orderBy('created_at', 'DESC');
        }
        if ($search) {
            $missions = $missions->search($search);
        }

        if ($state) {
            $missions = $missions->get();
            switch ($state) {
                case 'todo':
                    $missions = $missions->filter(fn ($planning) => $planning->realisation_state == 'À RÉALISER')->orderBy('created_at', 'DESC');
                    break;
                case 'active':
                    $missions = $missions->filter(fn ($planning) => $planning->realisation_state == 'EN COURS')->orderBy('created_at', 'DESC');
                    break;
                case 'delay':
                    $missions = $missions->filter(fn ($planning) => $planning->realisation_state == 'EN RETARD')->orderBy('created_at', 'DESC');
                    break;
                case 'done':
                    $missions = $missions->filter(fn ($planning) => $planning->realisation_state == 'RÉALISÉ')->orderBy('created_at', 'DESC');
                    break;
                default:
                    $missions = $missions;
                    break;
            }
            return PlanningResource::collection(new LengthAwarePaginator($missions, $missions->count(), 15));
        }

        if ($asPlanning) {
            $missions = $fetchAll ? $missions->get() : PlanningResource::collection($missions->paginate()->onEachSide(1));
        } else {
            $missions = $fetchAll ? $missions->get() : MissionResource::collection($missions->paginate()->onEachSide(1));
        }

        // dd($missions);
        return $missions;
    }

    public function missions_state()
    {
        $fetchAll = request()->has('fetchAll');
        $asPlanning = request()->has('asPlanning');
        $search = request()->has('search') ? request()->search : null;
        $order = request()->has('order') ?? request()->order;
        $state = request()->has('state') ? request()->state : false;

        if (hasRole(['dcp', 'dg'])) {
            $missions = new Mission;
        } elseif (hasRole('ci')) {
            $missions = auth()->user()->missions();
        } elseif (hasRole('cdc')) {
            $missions = Mission::whereIn('agency_id', auth()->user()->dre->agencies->pluck('id'));
        }
        if ($order) {
            foreach (request()->order as $key => $value) {
                $missions = $missions->orderBy($key, $value);
            }
        } else {
            $missions = $missions->orderBy('created_at', 'DESC');
        }
        if ($search) {
            $missions = $missions->search($search);
        }
        $missions = $missions->get();
        $todo = (clone $missions)->filter(fn ($planning) => $planning->realisation_state == 'À RÉALISER');
        $active = (clone $missions)->filter(fn ($planning) => $planning->realisation_state == 'EN COURS');
        $delay = (clone $missions)->filter(fn ($planning) => $planning->realisation_state == 'EN RETARD');
        $done = (clone $missions)->filter(fn ($planning) => $planning->realisation_state == 'RÉALISÉ' || $planning->realisation_state == 'Validé et envoyé');

        $todo = new LengthAwarePaginator($todo, $todo->count(), 5);
        $active = new LengthAwarePaginator($active, $active->count(), 5);
        $delay = new LengthAwarePaginator($delay, $delay->count(), 5);
        $done = new LengthAwarePaginator($done, $done->count(), 5);

        return compact('todo', 'active', 'delay', 'done');
    }

    /**
     * Display a listing of the resource (by campaign).
     */
    public function campaign(ControlCampaign $campaign)
    {
        $missions = Mission::where('control_campaign_id', $campaign->id);
        $fetchAll = request()->has('fetchAll');
        $asPlanning = request()->has('asPlanning');

        if ($asPlanning) {
            $missions = $fetchAll ? $missions->get() : PlanningResource::collection($missions->paginate()->onEachSide(1));
        } else {
            $missions = $fetchAll ? $missions->get() : MissionResource::collection($missions->paginate()->onEachSide(1));
        }

        return $missions;
    }

    /**
     * Display a listing of the resource (by mission & sample).
     */
    public function sampleDetails(Mission $mission, Sample $sample)
    {
        $details = $sample->details();
        $filter = request()->has('filter') ? request()->filter : null;
        if ($filter) {
            $details = $sample->details()->filter($filter);
        }
        return DetailsResource::collection($details->paginate()->onEachSide(1));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function show(Mission $mission)
    {
        // $samples = SampleResource::collection($mission->samples()->paginate()->onEachSide(2));
        // $mission->unsetRelation('samples');
        // dd($samples);
        return $mission;
        // return compact('mission', 'samples');
    }

    public function samples(Mission $mission)
    {
        $samples = $mission->samples();
        $filter = request()->has('filter') ? request()->filter : null;
        if ($filter) {
            $samples = $samples->filter($filter);
        }
        // dd(SampleResource::collection($samples->get()));
        $samples = $samples->paginate()->onEachSide(1);
        // return $samples;
        return SampleResource::collection($samples);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mission $mission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mission $mission)
    {
        //
    }

    public function confirm(Request $request, Mission $mission)
    {
        $data = Validator::make($request->all(), (new ReportRequest())->rules())->validate();
        if (hasRole('cdc')) {
            $data = [];
            $data['validated_by_id'] = auth()->user()->id;
            $data['validated_at'] = now();
            $data['validator_report'] = $request->mission_report;
        } else {
            $data['report'] = $request->mission_report;
            $data['controlled_by_id'] = auth()->user()->id;
            unset($data['mission_report']);
        }
        try {
            if ($mission->update($data)) {
                return response()->json([
                    'message' => __('Le rapport ' . $mission->reference . ' a été validé avec succès'),
                    'status' => true,
                ]);
            }
            return response()->json([
                'message' => __('Une erreur est survenue lors de la tentative d\'enregistrement des information de la mission'),
                'status' => false,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => __('Une erreur est survenue lors de la tentative d\'enregistrement des information de la mission'),
                'status' => false,
            ]);
        }
    }
}