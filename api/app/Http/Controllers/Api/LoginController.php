<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\FailedLoginException;
use App\Exceptions\UserNotVerifiedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginPostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginPostRequest $request)
    {

        if (!Auth::attempt($request->only(['email', 'password']))) {
            throw new FailedLoginException();
        }

        $user = Auth::user();

        if (!$user->hasVerifiedEmail()) {
//            throw new UserNotVerifiedException();
        }

        $user->load(['shops', 'roles']);

        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'message' => __('user.login.success'),
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => __('auth.logout')
        ]);
    }
}
