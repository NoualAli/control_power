<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\Detail\StoreRequest;
use App\Models\Mission;
use App\Models\MissionDetail;
use App\Models\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MissionDetailController extends Controller
{
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
        try {
            DB::transaction(function () use ($data) {
                foreach ($data['rows'] as $row) {
                    $detail = MissionDetail::findOrFail($row['detail']);

                    // Vidé les champs report et recovery_plan si la note égale 1
                    if ($row['score'] == 1) {
                        $row['report'] = null;
                        $row['recovery_plan'] = null;
                    }

                    if ($row['major_fact']) $row['score'] = 4;

                    // Mise à jour des informations dans la base de données
                    $detail->update([
                        'major_fact' => $row['major_fact'],
                        'score' => $row['score'],
                        'report' => $row['report'],
                        'recovery_plan' => $row['recovery_plan'],
                        'metadata' => !empty($row['metadata']) ? $row['metadata'] : null,
                        'executed_at' => now(),
                    ]);
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
}