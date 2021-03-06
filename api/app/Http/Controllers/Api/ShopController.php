<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShopPostRequest;
use App\Http\Requests\WithDateRangeRequest;
use App\Http\Resources\DefaultResource;
use App\Models\Shop;
use App\Models\ShopVisit;
use App\Models\User;
use App\Services\Personal\DateRangeCarbonBuilder;
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

    public function triggerVisit(Shop $shop)
    {
        $shop->addVisit();

        return response()->json([
            'message' => 'Successfully saved shop visit.'
        ]);
    }

    public function visitsPerShopReport(WithDateRangeRequest $request)
    {
        $dateRange = new DateRangeCarbonBuilder($request->input('start'), $request->input('end'));
        $dateRange->build();

        $perShopVisitsReport = Shop::getVisitsPerShop($dateRange)
            ->orderByVisits($request->has('direction') ? $request->input('direction') : 'desc')
            ->get();

        return DefaultResource::collection($perShopVisitsReport)->additional([
            'meta' => [
                'total' => $perShopVisitsReport->reduce(function ($total, $shop) {
                    return $total + $shop->visits;
                }, 0),
                'date_range' => $dateRange
            ]
        ]);
    }
}
