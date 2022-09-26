<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
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
                'name' => 'Admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Operator',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Leader',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Foreman',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Supervisor',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Manager',
                'guard_name' => 'web',
            ],
        ])->each(function ($role) {
            Role::create($role);
        });
    }
}
