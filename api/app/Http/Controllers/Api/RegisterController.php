<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterPostRequest;
use App\Http\Resources\DefaultResource;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Shop;
use App\Models\User;

class RegisterController extends Controller
{

    public function register(RegisterPostRequest $request)
    {

        $user = new User($request->only([
            'first_name', 'last_name', 'email', 'password'
        ]));
        $user->save();

        $shop = new Shop($request->only([
            'store_name'
        ]));
        $shop->save();

        $user->assignRole(Role::STORE_OWNER, $shop);

        return (new DefaultResource($user))->additional([
            'message' => __('user.register.success')
        ]);
    }
}
