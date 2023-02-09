<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\Detail\StoreRequest;
use App\Http\Resources\MissionDetailResource;
use App\Models\Media;
use App\Models\Mission;
use App\Models\MissionDetail;
use App\Models\Process;
use App\Traits\UploadFiles;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
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
        try {
            $details = hasRole(['dcp', 'dg', 'div']) ? (new MissionDetail) : auth()->user()->details();
            $details = $details->executed();

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
                foreach ($data['rows'] as $rowKey => $row) {
                    $detail = MissionDetail::findOrFail($row['detail']);;
                    // Vidé les champs report et recovery_plan si la note égale 1
                    if ($row['score'] == 1) {
                        $row['report'] = null;
                        $row['recovery_plan'] = null;
                    }

                    // Mettre la note max si jamais il y'a un fait majeur
                    if ($row['major_fact']) $row['score'] = max(array_keys($detail->controlPoint->scores_arr));

                    // Mise à jour des informations dans la base de données
                    $detail->update([
                        'major_fact' => $row['major_fact'],
                        'score' => $row['score'],
                        'report' => $row['report'],
                        'recovery_plan' => $row['recovery_plan'],
                        'metadata' => !empty($row['metadata']) ? $row['metadata'] : null,
                        'executed_at' => now(),
                    ]);

                    // Uplaod files
                    $files = $row['media'];
                    $media = Media::whereIn('id', $files)->get();
                    foreach ($media as $file) {
                        if (empty($file->attachable_type)) {
                            $file->update([
                                'attachable_type' => MissionDetail::class,
                                'attachable_id' => $detail->id,
                            ]);
                        }
                    }
                    // Notifier le DCP
                    Artisan::call('majorFact:detected', ['id' => $detail->id]);
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
        $mission = Mission::findOrFail(request()->mission_id);
        $process = Process::findOrFail(request()->process_id);
        $details = $mission->details()->whereRelation('process', 'processes.id', $process->id)->with('controlPoint')->get();
        return compact('mission', 'details', 'process');
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
        foreach ($data['rows'] as $rowKey => $row) {
            $detail = MissionDetail::findOrFail($row['detail']);;
            $controlPointFields = $detail->controlPoint->fields;
            if ($controlPointFields) {
                foreach ($controlPointFields as $field) {
                    $name = $field[2]->name;
                    $rules = $field[8]->rules;
                    $length = $field[3]->length;
                    if ($length) {
                        $rules = array_merge($rules, ['string', 'max:' . $field[3]->length]);
                    }
                    $computedName = 'rows.' . $rowKey . '.metadata.*.0.' . $name;
                    Validator::make($data, [$computedName => $rules])->validate();
                }
            }
        }
    }
}
