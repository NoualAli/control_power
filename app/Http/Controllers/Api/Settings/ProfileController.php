<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Models\User;
use App\Rules\IsAlgerianPhoneNumber;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Update the user's profile information.
     */
    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        try {
            $user->update($request->validated());

            return response()->json([
                'message' => UPDATE_PROFILE_SUCCESS,
                'status' => true,
                'user' => $user,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false,
                'user' => $user,
            ], $th->getCode());
        }
    }
}