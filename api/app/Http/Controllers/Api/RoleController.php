<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DefaultResource;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all()->pluck(['name'])->toArray();

        // for some reason DefaultResource sees $roles as string.
        return response()->json([
            'data' => $roles
        ]);
    }
}
