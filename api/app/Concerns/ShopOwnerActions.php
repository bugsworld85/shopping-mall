<?php

namespace App\Concerns;

use App\Http\Requests\WithDateRangeRequest;
use App\Models\Shop;
use App\Services\Personal\DateRangeCarbonBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

trait ShopOwnerActions
{
    /**
     * Get visits per day on a single shop.
     * Default to 1 month worth of data.
     * @param $q
     * @param WithDateRangeRequest|null $request
     * @return Builder
     */
    public function scopeGetVisitsPerDay($q, WithDateRangeRequest $request = null, Shop $shop = null): Builder
    {
        if ($request) {
            $dateRange = new DateRangeCarbonBuilder($request->input('start'), $request->input('end'));
        } else {
            $dateRange = new DateRangeCarbonBuilder();
        }
        $dateRange->build();

        return $q->select([
            'shops.id', 'shops.name',
            DB::raw("DATE(shop_visits.created_at) AS visit_date"),
            DB::raw('DAYNAME(shop_visits.created_at) AS visit_day'),
            DB::raw("COUNT(shop_visits.shop_id) AS visits")
        ])->leftJoin('shop_visits', 'shop_visits.shop_id', '=', 'shops.id')
            ->whereBetween('shop_visits.created_at', [$dateRange->start, $dateRange->end])
            ->where('shops.id', $this->id)
            ->groupBy('visit_date');
    }

    /**
     * Order result by visit date.
     * @param $q
     * @param string $direction
     * @return Builder
     */
    public function scopeOrderByDate($q, string $direction = 'ASC'): Builder
    {
        return $q->orderBy('visit_date', $direction);
    }
}
