<?php

namespace App\Concerns;

use App\Models\ShopUser;
use App\Models\User;

trait HasOwners
{
    /**
     * Assign owner to this shop.
     * @param User $user
     * @return ShopUser
     */
    public function assignOwner(User $user): ShopUser
    {
        return ShopUser::firstOrCreate([
            'shop_id' => $this->id,
        ], [
            'user_id' => $user->id,
        ]);
    }
}
