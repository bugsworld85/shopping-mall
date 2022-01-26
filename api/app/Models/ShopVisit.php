<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class)->withDefault();
    }
}
