<?php

namespace App\Http\Controllers\Api\V1\Mission;

use App\Enums\EventLogTypes;
use App\Enums\MissionState;
use App\Http\Controllers\Controller;
use App\Models\Mission;
use App\Http\Requests\Mission\Report\StoreRequest;
use App\Models\EventLog;
use App\Models\User;
use App\Notifications\Mission\Validated;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class MissionCommentController extends Controller
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
        if (hasRole('cdc') && $request->validated) {
            $totalUntreatedMajorFacts = $mission->details()->where('major_fact', true)->where('major_fact_is_rejected_at_dre', false)->whereNull('major_fact_is_dispatched_to_dcp_at')->count();
            if ($totalUntreatedMajorFacts) {
                $sentence = $totalUntreatedMajorFacts > 1 ? ' faits majeurs non traités' : ' fait majeur non traité';
                return actionResponse(false, '', "La mission <b>$mission->reference</b> ne peut pas être validée car elle contient <b>$totalUntreatedMajorFacts $sentence</b> !", 200);
            }
        }
        $data = $request->validated();
        $type = $data['type'];
        if ($type == 'cdc_report') {
            isAbleOrAbort(['create_cdc_report', 'validate_cdc_report']);
        } else if ($type == 'ci_report') {
            isAbleOrAbort(['create_ci_report', 'validate_ci_report']);
        } else {
            abort(500, "Le type $type est un type inconnu.");
        }

        try {
            $result = DB::transaction(function () use ($data, $mission) {
                $hasId = isset($data['id']) && !empty($data['id']);
                $comment = $hasId ? $mission->comment : null;
                $type = $data['type'];
                $validated = boolval($data['validated']);
                $content = $data['content'];
                $attributes = $this->commentAttributes($mission, $type, $hasId);
                $message = $attributes['message'];
                $realEnd = $mission->real_end;
                $users = [];
                if ($comment && !$validated) {
                    $comment->update([
                        'content' => $content,
                        'creator_full_name' => getUserFullNameWithRole(),
                    ]);
                } else {
                    $comment = $mission->comments()->create([
                        'content' => $content,
                        'type' => $type,
                        'creator_full_name' => getUserFullNameWithRole(),
                        'created_by_id' => auth()->user()->id,
                    ]);
                    $realEnd = hasRole('cdc') ? now() : $mission->real_end;
                }

                if ($validated) {
                    if ($type == 'ci_report') {
                        $missionState = MissionState::PENDING_CDC_VALIDATION;
                    } elseif ('cdc_report') {
                        $missionState = MissionState::PENDING_CDCR_VALIDATION;
                    }
                    $users = $this->getUsers($mission, $type);
                    $mission->update([
                        $attributes['validationAtColumn'] => now(),
                        $attributes['validationByIdColumn'] => auth()->user()->id,
                        $attributes['persistedValidationColumn'] => strlen($attributes['persistedValidationColumn']) ? getUserFullNameWithRole() : null,
                        'real_end' => $realEnd,
                        'current_state' => $missionState
                    ]);
                    EventLog::store(['type' => EventLogTypes::VALIDATE, 'attachable_type' => Mission::class, 'attachable_id' => $mission->id, 'payload' => ['success' => true, 'content' => MISSION_VALIDATION_SUCCESS]]);
                }
                return compact('mission', 'users', 'type', 'message');
            });
            $isValidated = hasRole('ci') ? (bool) $mission->ci_validation_at : $mission->cdc_validation_at;
            if ($isValidated) {
                $this->notifyUsers($result['mission'], $result['users'], $result['type']);
            }
            return actionResponse(true, $result['message'], $result['message']);
        } catch (\Throwable $th) {
            EventLog::store(['type' => EventLogTypes::VALIDATE, 'attachable_type' => Mission::class, 'attachable_id' => $mission->id, 'payload' => ['success' => false, 'content' => $th->getMessage()]]);
            return throwedError($th);
        }
    }

    /**
     * Format database attributes
     *
     * @param Mission $mission
     * @param string $type
     * @param bool $update
     *
     * @return array
     */
    private function commentAttributes(Mission $mission, string $type, bool $update = false)
    {
        switch ($type) {
            case 'ci_report':
                $validationByIdColumn = 'ci_validation_by_id';
                $validationAtColumn = 'ci_validation_at';
                $persistedValidationColumn = '';
                $message = $update ? 'Votre conclusion a été mise à jour avec succès' : 'Votre conclusion a été enregistrée avec succès';
                break;
            case 'cdc_report':
                $validationByIdColumn = 'cdc_validation_by_id';
                $validationAtColumn = 'cdc_validation_at';
                $persistedValidationColumn = 'cdc_validator_full_name';
                $message = $update ? 'Votre conclusion a été mise à jour avec succès' : 'Votre conclusion a été enregistrée avec succès';
                break;
            default:
                $validationByIdColumn = 'ci_validation_by_id';
                $validationAtColumn = 'ci_validation_at';
                $persistedValidationColumn = '';
                $message = $update ? 'Votre conclusion a été mise à jour avec succès' : 'Votre conclusion a été enregistrée avec succès';
                break;
        }

        return compact('validationByIdColumn', 'validationAtColumn', 'persistedValidationColumn', 'message');
    }

    /**
     * Get users list to notify
     *
     * @param App\Models\Mission $mission
     * @param mixed $report
     *
     * @return App\Models\User|Collection
     */
    private function getUsers(Mission $mission, $type)
    {
        if ($type == 'cdc_report') {
            $users = User::whereRoles(['cdcr'])->get();
        } elseif ($type == 'ci_report') {
            $users = $mission->creator;
        }

        return $users;
    }

    /**
     * Notify concerned users
     *
     * @param Mission $mission
     * @param Collection|User $users
     * @param string $type
     *
     * @return JsonReponse
     */
    private function notifyUsers(Mission $mission, Collection|User $users, string $type)
    {
        try {
            if ($users instanceof Collection) {
                foreach ($users as $user) {
                    Notification::send($user, new Validated($mission, $type));
                }
            } else {
                Notification::send($users, new Validated($mission, $type));
            }
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }
}
