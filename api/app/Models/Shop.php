<?php

namespace App\Models;

use App\Concerns\HasOwners;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory, HasOwners;

    protected $fillable = [
        'name', 'image'
    ];

    public function users()
    {
        return $this->hasManyThrough(
            User::class,
            ShopUser::class,
            'shop_id',
            'id',
            'id',
            'user_id'
        );
    }
}
