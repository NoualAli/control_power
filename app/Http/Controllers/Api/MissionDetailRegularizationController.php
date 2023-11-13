<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\Detail\Regularization\StoreRequest;
use App\Http\Resources\MissionDetailRegularizationResource;
use App\Models\Media;
use App\Models\MissionDetail;
use App\Models\MissionDetailRegularization;
use Illuminate\Support\Facades\DB;

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
            // dd($data);
            $res = DB::transaction(function () use ($data, $detail) {
                $data['created_by_id'] = auth()->user()->id;
                $data['created_at'] = now();
                $media = [];
                if (isset($data['media'])) {
                    $media = $data['media'];
                    unset($data['media']);
                }
                $regularization = MissionDetailRegularization::create($data);
                if (count($media)) {
                    $media = Media::whereIn('id', $media)->get();
                    foreach ($media as $item) {
                        $item->update(['attachable_id' => $regularization->id]);
                    }
                }
                if ($regularization->is_regularized) {
                    $detail->update(['is_regularized' => true]);
                }
                return $regularization;
            });
            if ($res) {
                return response()->json([
                    'message' => CREATE_SUCCESS,
                    'status' => true,
                ]);
            }
            return response()->json([
                'message' => CREATE_ERROR,
                'status' => false,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false,
            ]);
        }
    }

    public function show(MissionDetail $detail)
    {
        $detail->unsetRelations();
        $detail->load(['regularizations' => fn ($query) => $query->with('media')->orderBy('mission_detail_regularizations.created_at', 'DESC')]);
        $regularizations = MissionDetailRegularizationResource::collection($detail->regularizations()->get());
        return $regularizations;
    }
}
