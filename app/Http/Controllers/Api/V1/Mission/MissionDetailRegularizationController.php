<?php

namespace App\Http\Controllers\Api\V1\Mission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\Detail\Regularization\RejectRequest;
use App\Http\Requests\Mission\Detail\Regularization\StoreComment;
use App\Http\Requests\Mission\Detail\Regularization\StoreRequest;
use App\Http\Resources\MissionDetailRegularizationResource;
use App\Models\MissionDetail;
use App\Models\MissionDetailRegularization;
use App\Notifications\MissionDetailRegularizationRejected;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class MissionDetailRegularizationController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, MissionDetail $detail)
    {
        try {
            $data = $request->validated();
            $res = DB::transaction(function () use ($data, $detail) {
                $data['created_by_id'] = auth()->user()->id;
                $data['created_at'] = now();
                $data['creator_full_name'] = getUserFullNameWithRole();
                $media = [];
                if (isset($data['media'])) {
                    $media = $data['media'];
                    unset($data['media']);
                }
                $regularization = MissionDetailRegularization::create($data);
                if (count($media)) {
                    $media = getMedia($media)->get();
                    foreach ($media as $item) {
                        $updatedItem = DB::table('has_media')->where('media_id', $item->id)->update([
                            'attachable_id' => $regularization->id
                        ]);
                    }
                }
                $detail->update(['reg_is_sanitation_in_progress' => $regularization->is_sanitation_in_progress, 'reg_is_rejected' => false, 'reg_is_regularized' => $regularization->is_regularized]);

                return $regularization;
            });
            return actionResponse($res->wasRecentlyCreated, "Régularisation enregistrée avec succès", CREATE_ERROR, 200);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    public function show(MissionDetail $detail)
    {
        $detail->unsetRelations();
        $detail->load(['regularizations' => fn ($query) => $query->with('media')->orderBy('mission_detail_regularizations.created_at', 'DESC')]);
        $regularizations = MissionDetailRegularizationResource::collection($detail->regularizations()->get());
        return $regularizations;
    }

    /**
     * @param RejectRequest $request
     * @param MissionDetailRegularization $regularization
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function reject(RejectRequest $request, MissionDetailRegularization $regularization)
    {
        try {
            $result = DB::transaction(function () use ($regularization, $request) {
                $data = $request->validated();
                $data['is_regularized'] = false;
                // $data['rejection_comment'] = $data['comment'];
                $data['is_rejected'] = true;
                $data['rejected_at'] = now();
                $data['rejected_by_id'] = auth()->user()->id;
                $data['rejector_full_name'] = getUserFullNameWithRole();
                $comment = $data['comment'];
                unset($data['comment'], $data['regularization_id']);
                $resultRegularization = $regularization->update($data);
                $resultDetail = $regularization?->detail()->update(['reg_is_regularized' => false, 'reg_is_rejected' => true, 'reg_is_sanitation_in_progress' => false]);
                $comment = $regularization->comment()->create([
                    'content' => $comment,
                    'type' => 'rejection_comment',
                    'created_by_id' => auth()->user()->id,
                    'creator_full_name' => getUserFullNameWithRole(),
                ]);

                return $resultDetail && $resultRegularization;
            });
            if ($result) {
                $user = $regularization->regularizator;
                Notification::send($user, new MissionDetailRegularizationRejected($regularization));
            }
            return actionResponse($result, "Régularisation rejetée avec succès !");
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    /**
     * @param StoreComment $request
     * @param MissionDetailRegularization $regularization
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function comment(StoreComment $request, MissionDetailRegularization $regularization)
    {
        try {
            $result = $regularization->comment()->create([
                'content' => $request->comment,
                'type' => strtolower(auth()->user()->role->code) . '_regularization_comment',
                'created_by_id' => auth()->user()->id,
                'creator_full_name' => getUserFullNameWithRole(),
            ]);
            return actionResponse($result->wasRecentlyCreated, "Commentaire enregistrer avec succès");
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }
}
