<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image'
    ];

    public function users()
    {
        return $this->hasManyThrough(
            User::class,
            RoleUser::class,
            'shop_id',
            'id',
            'id',
            'user_id'
        );
    }
}
