<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\FailedLoginException;
use App\Exceptions\UserNotVerifiedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginPostRequest;
use App\Http\Resources\DefaultResource;
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

        $token = $user->createToken('API Token')->plainTextToken;

        return (new DefaultResource([
            'user' => $user,
            'token' => $token
        ]))->additional([
            'message' => __('user.login.success'),
        ]);
    }
}
