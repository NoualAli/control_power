<?php

namespace App\Http\Controllers\Api\V1\Mission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\Detail\Regularization\RejectRequest;
use App\Http\Requests\Mission\Detail\Regularization\StoreRequest;
use App\Http\Resources\MissionDetailRegularizationResource;
use App\Models\Media;
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
                // $detail->update(['reg_is_regularized' => true, 'reg_is_rejected' => false]);
                // if ($regularization->is_regularized) {
                // } elseif ($regularization->is_sanitation_in_progress) {
                // }
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

    public function reject(RejectRequest $request, MissionDetailRegularization $regularization)
    {
        try {
            $result = DB::transaction(function () use ($regularization, $request) {
                $data = $request->validated();
                $data['is_regularized'] = false;
                $data['rejection_comment'] = $data['comment'];
                $data['is_rejected'] = true;
                $data['rejected_at'] = now();
                $data['rejector_full_name'] = getUserFullNameWithRole();
                unset($data['comment'], $data['regularization_id']);
                $resultRegularization = $regularization->update($data);
                $resultDetail = $regularization?->detail()->update(['reg_is_regularized' => false, 'reg_is_rejected' => true, 'reg_is_sanitation_in_progress' => false]);

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

    // public function derComment(,MissionDetailRegularization $regularization)
    // {
    //     $regularization->derComment()->create([
    //         'content'
    //     ]);
    // }/
}
