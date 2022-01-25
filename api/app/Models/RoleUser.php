<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RoleUser extends Pivot
{
    use HasFactory;

    /**
     * For some reason it keeps on pulling from role_user table which was clearly not defined during migration. Weird.
     *
     * @var string
     */
    protected $table = 'role_users';

    public $timestamps = [];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
