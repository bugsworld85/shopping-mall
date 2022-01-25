<?php

namespace App\Concerns;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Shop;

trait RoleAssignment
{
    /**
     * Assign role to current user.
     *
     * @param Shop|null $shop
     * @param string $role
     * @return RoleUser
     */
    public function assignRole(string $role, Shop $shop = null): RoleUser
    {
        $role = Role::firstWhere('code', $role);

        $roleUser = new RoleUser([
            'user_id' => $this->id,
            'role_id' => $role->id,
            'shop_id' => $shop->id
        ]);
        $roleUser->save();

        return $roleUser;
    }

    /**
     * Remove a role from this user.
     *
     * @param Shop $shop
     * @param string $role
     */
    public function removeRole(string $role, Shop $shop)
    {
        $role = Role::firstWhere('code', $role);

        $this->userRoles()
            ->where('role_id', $role->id)
            ->where('shop_id', $shop->id)
            ->delete();
    }
}
