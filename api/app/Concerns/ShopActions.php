<?php

namespace App\Concerns;

use App\Http\Requests\WithDateRangeRequest;
use App\Models\ShopVisit;
use App\Services\Personal\DateRangeCarbonBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

trait ShopActions
{
    /**
     * Add visit to shop.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addVisit(): \Illuminate\Database\Eloquent\Model
    {
        return $this->shopVisits()->create();
    }

    /**
     * Get visits per shop on all shops.
     * @param $q
     * @param WithDateRangeRequest|null $request
     * @return Builder
     */
    public function scopeGetVisitsPerShop($q, WithDateRangeRequest $request = null): Builder
    {
        $dateRange = new DateRangeCarbonBuilder($request->input('start'), $request->input('end'));
        $dateRange->build();

        return $q->select([
            'shops.id', 'shops.name',
            DB::raw("COUNT(shop_visits.shop_id) AS visits"),
            DB::raw("DATE(MIN(shop_visits.created_at)) AS start_date"),
            DB::raw("DATE(MAX(shop_visits.created_at)) AS end_date"),
        ])->leftJoin('shop_visits', 'shop_visits.shop_id', '=', 'shops.id')
            ->whereBetween('shop_visits.created_at', [$dateRange->start, $dateRange->end])
            ->groupBy('shops.id');
    }

    /**
     * Order result by number of visits
     * @param $q
     * @param string $direction
     * @return Builder
     */
    public function scopeOrderByVisits($q, string $direction = 'ASC'): Builder
    {
        return $q->orderBy('visits', $direction);
    }
}
