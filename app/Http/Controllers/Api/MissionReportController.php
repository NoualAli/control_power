<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use App\Http\Requests\Mission\Report\StoreRequest;
use App\Http\Requests\Mission\Report\ValidateRequest;
use App\Models\MissionReport;
use Exception;
use Illuminate\Support\Facades\DB;

class MissionReportController extends Controller
{
    /**
     * Store mission report
     *
     * @param StoreRequest $request
     * @param Mission $mission
     *
     * @return JsonReponse
     */
    public function store(StoreRequest $request, Mission $mission)
    {
        try {
            $data = $request->validated();
            $hasId = isset($data['id']) && !empty($data['id']);
            $report = $hasId ? MissionReport::findOrFail($data['id']) : null;
            DB::transaction(function () use ($data, $mission, $report) {
                $validatedAt = boolval($data['validated']) ? now() : null;
                $content = isset($data['opinion']) ? $data['opinion'] : $data['report'];
                if ($report) {
                    if (!$report->is_validated) {
                        $report->update([
                            'content' => $content,
                            'validated_at' => $validatedAt,
                        ]);
                    } else {
                        throw new Exception(UPDATE_ERROR, 403);
                    }
                } else {
                    $mission->reports()->create([
                        'content' => $content,
                        'type' => $data['type'],
                        'created_by_id' => auth()->user()->id,
                        'validated_at' => $validatedAt,
                    ]);
                }
            });
            $message = $hasId ? UPDATE_SUCCESS : CREATE_SUCCESS;
            return response()->json([
                'message' => $message,
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false,
            ]);
        }
    }

    /**
     * Validate mission report
     *
     * @param ValidateRequest $request
     * @param Mission $mission
     *
     * @return JsonReponse
     */
    public function validateReport(ValidateRequest $request, Mission $mission)
    {
        try {
            $data = $request->validated();

            DB::transaction(function () use ($data, $mission) {
                $report = null;
                switch (request()->type) {
                    case 'Avis contrôleur':
                        $report = request()->mission->controller_opinion;
                        break;
                    default:
                        $report = request()->mission->head_of_department_report;
                        break;
                }
                $report->update(['validated_at' => now()]);
            });
            return response()->json([
                'message' => UPDATE_SUCCESS,
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false,
            ]);
        }
    }
}
