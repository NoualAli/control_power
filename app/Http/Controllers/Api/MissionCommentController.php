<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use App\Http\Requests\Mission\Report\StoreRequest;
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
            return DB::transaction(function () use ($data, $mission) {
                $hasId = isset($data['id']) && !empty($data['id']);
                $comment = $hasId ? $mission->comment : null;
                $type = $data['type'];
                $validated = boolval($data['validated']);
                $content = $data['content'];
                $attributes = $this->commentAttributes($mission, $type, $hasId);
                $validationAtColumn = $attributes['validationAtColumn'];
                $validationByIdColumn = $attributes['validationByIdColumn'];
                $message = $attributes['message'];

                if ($comment && !$validated) {
                    $comment->update([
                        'content' => $content,
                    ]);
                } else {
                    $comment = $mission->comments()->create([
                        'content' => $content,
                        'type' => $type,
                        'created_by_id' => auth()->user()->id,
                    ]);
                }

                if ($validated) {
                    $users = $this->getUsers($mission, $type);
                    $this->notifyUsers($mission, $users, $type);
                    $mission->update([
                        $validationByIdColumn => auth()->user()->id,
                        $validationAtColumn => now()
                    ]);
                }

                return response()->json([
                    'message' => $message,
                    'status' => true,
                ]);
            });
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false,
            ]);
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
                $message = $update ? 'Votre compte-rendu a été mis à jour avec succès' : 'Votre compte-rendu a été créé avec succès';
                break;
            case 'cdc_report':
                $validationByIdColumn = 'cdc_validation_by_id';
                $validationAtColumn = 'cdc_validation_at';
                $message = $update ? 'Votre rapport a été mis à jour avec succès' : 'Votre rapport a été créé avec succès';
                break;
            default:
                $validationByIdColumn = 'ci_validation_by_id';
                $validationAtColumn = 'ci_validation_at';
                $message = $update ? 'Votre avis a été mis à jour avec succès' : 'Votre avis a été créé avec succès';
                break;
        }

        return compact('validationByIdColumn', 'validationAtColumn', 'message');
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
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false,
            ]);
        }
    }
}
