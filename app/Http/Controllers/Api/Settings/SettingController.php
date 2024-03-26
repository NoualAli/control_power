<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ResetRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    /**
     * Reset user informations
     *
     * @param ResetRequest $request
     * @param User $user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function reset(ResetRequest $request, User $user)
    {
        try {
            $data = $request->validated();
            $result = DB::transaction(function () use ($data, $user) {
                $data['must_change_password'] = false;
                $data['password'] = Hash::make($data['password']);
                return $user->update($data);
            });
            return actionResponse($result, 'Vos information on été enregister avec succès.');
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }
}
