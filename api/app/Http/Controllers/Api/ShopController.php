<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShopPostRequest;
use App\Http\Resources\DefaultResource;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        return DefaultResource::collection([]);
    }

    public function create(ShopPostRequest $request)
    {
        $shop = new Shop($request->only(['name']));
        $shop->save();

        return (new DefaultResource($shop))->additional([
            'message' => __('shop.create.success')
        ]);
    }
}
