<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\Detail\Regularization\StoreRequest;
use App\Models\MissionDetail;
use App\Models\Regularization;
use App\Models\User;
use App\Notifications\Mission\Detail\Regularized;
use App\Notifications\Mission\Detail\Unregularized;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class RegularizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

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
                if ($data['regularized']) {
                    $data['regularized_by_id'] = auth()->user()->id;
                    $data['regularized_at'] = now();
                }
                unset($data['regularized'], $data['detail_id']);

                if (isset($data['id'])) {
                    $regularization = Regularization::findOrFail($data['id']);
                    unset($data['id']);
                    if ($regularization->is_regularized) {
                    }
                    $regularization->update($data);
                } else {
                    $regularization = Regularization::create($data);
                }
                return $detail->update(['regularization_id' => $regularization->id]);
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
}
