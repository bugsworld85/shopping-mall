<?php

namespace App\Concerns;

use App\Models\Shop;
use App\Models\ShopUser;

trait HasShops
{
    /**
     * Assign shop to current user.
     * @param \App\Models\Shop $shop
     * @return ShopUser
     */
    public function assignShop(Shop $shop): ShopUser
    {
        return ShopUser::firstOrCreate([
            'user_id' => $this->id,
        ], [
            'shop_id' => $shop->id,
        ]);
    }

    public function isOwner(Shop $shop): bool
    {
        $shopUser = $this->shops()->firstWhere('shop_id', $shop->id);

        return $shopUser != null;
    }
}
