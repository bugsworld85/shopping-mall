<?php

namespace App\Concerns;

use App\Models\ShopVisit;

trait ShopActions
{
    /**
     * Add visit to shop.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addVisit(): \Illuminate\Database\Eloquent\Model
    {
        return $this->shopVisit()->create();
    }
}
