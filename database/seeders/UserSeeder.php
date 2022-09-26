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
                'name' => 'Refinaldy',
                'npk' => '000000000000000',
                'email' => 'refinaldy@test.test',
                'password' => Hash::make('password'),
                'department_id' => 1, 
            ],
            [
                'name' => 'Shinta',
                'npk' => '11111111111111111',
                'email' => 'shinta@test.test',
                'password' => Hash::make('password'),
                'department_id' => 2,
            ],
            [
                'name' => 'Ananda TS',
                'npk' => '222222222222222222',
                'email' => 'ananda@test.test',
                'password' => Hash::make('password'),
                'department_id' => 3,
            ],
        ])->each(function ($user) {
            $user = User::create($user);
            $user->id === 1 ? $user->assignRole('Admin') : $user->assignRole('Operator');
        });
        
        
        
    }
}
