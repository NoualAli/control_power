<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdatePasswordRequest;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(UpdatePasswordRequest $request)
    {
        $user = auth()->user();
        try {
            $result = $user->update([
                'password' => Hash::make($request->new_password),
                'must_change_password' => false,
            ]);

            return actionResponse($result, UPDATE_PASSWORD_SUCCESS);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }
}
