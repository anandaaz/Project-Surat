<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'name' => 'create-role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit-role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'show-role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete-role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create-permission',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit-permission',
                'guard_name' => 'web',
            ],
            [
                'name' => 'show-permission',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete-permission',
                'guard_name' => 'web',
            ],
        ])->each(function ($permission) {
            $permission = Permission::create($permission);
            $roles = Role::all();
            $permissionExploded = explode('-', $permission->name);
            foreach($roles as $role){
               $roles = $role->name === 'Admin' ? $role->givePermissionTo($permission) : ($permissionExploded[0] === 'show' ? $role->givePermissionTo($permission) : false);
            }
        });
    }
}
