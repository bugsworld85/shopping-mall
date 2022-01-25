<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterPostRequest;
use App\Http\Resources\DefaultResource;
use App\Models\User;

class RegisterController extends Controller
{

    public function register(RegisterPostRequest $request)
    {

        $user = new User($request->only([
            'first_name', 'last_name', 'email', 'password'
        ]));
        $user->save();

        // Registered user is automatically a store user.

        return (new DefaultResource($user))->additional([
            'message' => __('user.register.success')
        ]);
    }
}
