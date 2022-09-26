<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
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
                'name' => 'Engineering',
            ],
            [
                'name' => 'Production',
            ],
            [
                'name' => 'Finance',
            ],
            [
                'name' => 'PPIC',
            ],
        ])->each(function ($department) {
            Department::create($department);
        });
    }
}
