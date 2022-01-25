<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
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
        $assignment = [
            Role::SUPER_ADMIN => [
                Permission::CAN_CREATE_USER,
                Permission::CAN_VIEW_USER,
                Permission::CAN_EDIT_USER,
                Permission::CAN_DELETE_USER,
            ],
            Role::MALL_MANAGER => [
                Permission::CAN_VIEW_COMBINED_REPORTS,
                Permission::CAN_VIEW_REPORTS
            ],
            Role::STORE_OWNER => [
                Permission::CAN_VIEW_REPORTS,
            ]
        ];

        $permissions = (new \ReflectionClass(Permission::class))->getConstants();

        unset($permissions['CREATED_AT']);
        unset($permissions['UPDATED_AT']);

        foreach ($permissions as $permission) {
            Permission::updateOrCreate([
                'code' => $permission,
            ], [
                'name' => ucwords(str_replace('_', ' ', $permission))
            ]);
        }

        $permissions = Permission::all();

        foreach ($assignment as $role => $defaultPermissions) {
            $roleModel = Role::updateOrCreate([
                'code' => $role,
            ], [
                'name' => ucwords(str_replace('_', ' ', $role))
            ]);

            foreach ($defaultPermissions as $defaultPermission) {
                /**
                 * Making sure no overlapping of permissions within a role.
                 */
                RolePermission::where('role_id', $roleModel->id)->delete();

                $permission = $permissions->firstWhere('code', $defaultPermission);

                if ($permission != null) {
                    $rolePermission = new RolePermission();
                    $rolePermission->role_id = $roleModel->id;
                    $rolePermission->permission_id = $permission->id;
                    $rolePermission->save();
                }
            }
        }
    }
}
