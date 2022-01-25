<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserPostRequest;
use App\Http\Requests\EditUserPutRequest;
use App\Http\Requests\RegisterPostRequest;
use App\Http\Resources\DefaultResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('last_name', 'ASC')
            ->with([
                'shops', 'roles'
            ])->paginate(25);

        return DefaultResource::collection($users);
    }

    public function create(CreateUserPostRequest $request)
    {
        $user = new User($request->only([
            'first_name', 'last_name', 'email', 'password'
        ]));
        $user->save();

        return (new DefaultResource($user))->additional([
            'message' => __('user.register.success')
        ]);
    }

    public function edit(EditUserPutRequest $request, User $user)
    {
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();

        return (new DefaultResource($user))->additional([
            'message' => __('user.edit.success')
        ]);
    }

    public function delete(User $user)
    {
        $user->delete();

        return (new DefaultResource($user))->additional([
            'message' => __('user.delete.success')
        ]);
    }
}
