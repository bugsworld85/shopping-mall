<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShopPostRequest;
use App\Http\Resources\DefaultResource;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::orderBy('name', 'ASC')
            ->paginate(25);

        return DefaultResource::collection($shops);
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
