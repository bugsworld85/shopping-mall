<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DefaultResource;
use App\Models\User;
use Illuminate\Http\Request;

class OwnerShopController extends Controller
{


    public function index(User $user)
    {
        return DefaultResource::collection($user->shops);
    }

    public function activeShop()
    {
        // get shop_id from session.
        // pull shop model
        // return active shop.

        return '';
    }

    public function makeShopActive(Shop $shop)
    {
        // add shop id into session.
        
    }
}
