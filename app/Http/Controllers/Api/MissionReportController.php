<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use App\Http\Requests\Mission\Report\StoreRequest;
use App\Http\Requests\Mission\Report\ValidateRequest;
use App\Models\MissionReport;
use App\Models\User;
use App\Notifications\Mission\Validated;
use Exception;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

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
        $data = $request->validated();
        if ($data['type'] == 'Rapport') {
            isAbleOrAbort(['create_dre_report', 'validate_dre_report']);
        } else {
            isAbleOrAbort(['create_opinion', 'validate_opinion']);
        }
        try {
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

                    // if ($data['type'] == 'Avis contrôleur') {
                    //     $state = today()->diffInDays($mission->end) > 0 ? 'En attente de validation' : 'En attente de validation (en retard)';
                    //     $mission->states()->create(['state' => $state]);
                    // }
                    // if ($data['type'] == 'Rapport') {
                    //     $state = today()->diffInDays($mission->end) > 0 ? 'Validé et envoyé' : 'Validé et envoyé (en retard)';
                    //     $mission->states()->create(['state' => $state]);
                    // }
                }

                if ($report->is_validated) {
                    $users = $this->getUsers($mission, $report);
                    $this->notifyUsers($mission, $users);
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
        $data = $request->validated();
        try {
            DB::transaction(function () use ($data, $mission) {
                $report = null;
                $type = $data['type'];
                $column = '';
                switch ($type) {
                    case 'Avis contrôleur':
                        $report = request()->mission->opinion;
                        $column = 'executed_at';
                        break;
                    default:
                        $report = request()->mission->dre_report;
                        $column = 'validated_at';
                        break;
                }
                $report->update(['validated_at' => now()]);

                foreach ($mission->details()->whereNull($column)->get() as $detail) {
                    $detail->update([$column => now()]);
                }

                // if ($data['type'] == 'Avis contrôleur') {
                //     $state = today()->diffInDays($mission->end) > 0 ? 'En attente de validation' : 'En attente de validation (en retard)';
                //     $mission->states()->create(['state' => $state]);
                // }
                // if ($data['type'] == 'Rapport') {
                //     $state = today()->diffInDays($mission->end) > 0 ? 'Validé et envoyé' : 'Validé et envoyé (en retard)';
                //     $mission->states()->create(['state' => $state]);
                // }

                $users = $this->getUsers($mission, $report);
                $this->notifyUsers($mission, $users);
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

    private function getUsers($mission, $report)
    {
        if ($report->type == 'Rapport') {
            $dre = User::whereRoles(['dre'])
                ->whereAgencies([$mission->agency->id])
                ->first();

            $agencyControllers = $mission->agencyControllers;

            $users = User::whereRoles(['cdcr', 'dcp', 'der'])
                ->without(['missions', 'campaigns', 'details', 'regularization', 'logins'])
                ->get()
                ->merge($agencyControllers);

            if ($dre) {
                $users = $users->push($dre);
            }
        } elseif ($report->type == 'Avis contrôleur') {
            $users = $mission->creator;
        }
        return $users;
    }

    private function notifyUsers(Mission $mission, Collection|User $users)
    {
        try {
            if ($users instanceof Model) {
                Notification::send($users, new Validated($mission));
            } else {
                foreach ($users as $user) {
                    Notification::send($user, new Validated($mission));
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
