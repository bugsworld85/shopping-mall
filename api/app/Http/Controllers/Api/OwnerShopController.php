<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DefaultResource;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;

class OwnerShopController extends Controller
{


    public function index(Request $request)
    {
        $shops = $request->user()->shops()->orderBy('name')->paginate(25);

        return DefaultResource::collection($shops);
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

    public function reports(Shop $shop)
    {

    }
}
