<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'super_admin' => [
                'can_create_user',
                'can_view_user',
                'can_edit_user',
                'can_delete_user',
                'can_create_shop',
                'can_edit_shop',
                'can_view_shop',
                'can_delete_shop',
            ],
            'mall_manager' => [
                'can_view_combined_reports',
                'can_create_shop',
                'can_edit_shop',
                'can_view_shop',
                'can_delete_shop',
            ],
            'store_owner' => [
                'can_view_store_reports',
            ]
        ];

        collect($roles)->each(function ($permissions, $role) {
            try {
                $role = Role::create(['name' => $role]);
                $this->command->info($role->name);
            } catch (\Throwable $e) {
                $this->command->warn($e->getMessage());
            }
            collect($permissions)->each(function ($permission) use ($role) {
                try {
                    $permission = Permission::create(['name' => $permission]);
                    $this->command->comment($permission->name);
                    $role->givePermissionTo($permission);
                } catch (\Throwable $e) {
                    $this->command->warn($e->getMessage());
                }
            });
        });
    }
}
