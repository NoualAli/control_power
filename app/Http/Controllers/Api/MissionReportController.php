<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use App\Http\Requests\Mission\Report\StoreRequest;
use App\Http\Requests\Mission\Report\ValidateRequest;
use App\Models\MissionReport;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
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
            $report = DB::transaction(function () use ($data, $mission, $report) {
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
                    $report = $mission->reports()->create([
                        'content' => $content,
                        'type' => $data['type'],
                        'created_by_id' => auth()->user()->id,
                        'validated_at' => $validatedAt,
                    ]);
                }

                if ($report->is_validated) {
                    if ($report->type == 'Avis contrôleur') {
                        $this->notifyUser($mission, $mission->creator);
                    } elseif ($report->type == 'Rapport') {
                        $users = $mission->controllers->push(User::dcp());
                        $this->notifyUser($mission, $users);
                    }
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
                if ($report->type == 'Avis contrôleur') {
                    $this->notifyUsers($mission, $mission->creator);
                } elseif ($report->type == 'Rapport') {
                    // $users = $mission->controllers->push(User::dcp());
                    $users = User::dcp()->merge($mission->controllers);
                    $this->notifyUsers($mission, $users);
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
            ]);
        }
    }

    private function notifyUsers(Mission $mission, Collection|User $users)
    {
        try {
            if ($users instanceof Model) {
                Artisan::call('mission:validated', ['id' => $mission->id, 'user_id' => $users->id]);
            } else {
                foreach ($users as $user) {
                    if ($user?->id) {
                        Artisan::call('mission:validated', ['id' => $mission->id, 'user_id' => $user?->id]);
                    }
                }
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false,
            ]);
        }
    }
}
