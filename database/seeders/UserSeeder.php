<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'username' => 'refinaldy',
                'name' => 'Refinaldy',
                'npk' => '0912N',
                'email' => 'refinaldy@test.test',
                'password' => Hash::make('password'),
                'department_id' => 1, 
            ],
            [
                'username' => 'shinta',
                'name' => 'Shinta',
                'npk' => '123N',
                'email' => 'shinta@test.test',
                'password' => Hash::make('password'),
                'department_id' => 2,
            ],
            [
                'username' => 'ananda TS',
                'name' => 'Ananda TS',
                'npk' => '987K',
                'email' => 'ananda@test.test',
                'password' => Hash::make('password'),
                'department_id' => 3,
            ],
            [
                'username' => 'anandats',
                'name' => 'Ananda TS 2',
                'npk' => '9121',
                'email' => 'ananda2@test.test',
                'password' => Hash::make('password'),
                'department_id' => 4,
            ],
        ])->each(function ($user) {
            $user = User::create($user);
            $user->id === 1 ? $user->assignRole('Admin') : $user->assignRole('Operator');
        });
        
        
        
    }
}
