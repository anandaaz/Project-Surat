<?php

namespace Database\Seeders;

use App\Models\LetterType;
use Illuminate\Database\Seeder;

class LetterTypeSeeder extends Seeder
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
                'name' => 'Surat Lembur',
                'description' => 'Untuk Lembur',
                'department_id' => '1',
                'user_id' => 1,
            ],
            [
                'name' => 'Surat Izin',
                'description' => 'Untuk Izin',
                'department_id' => '1',
                'user_id' => 1,
            ],
            [
                'name' => 'Surat Sakit',
                'description' => 'Untuk Sakit',
                'department_id' => '1',
                'user_id' => 1,
            ],
           
            [
                'name' => 'Surat Cuti',
                'description' => 'Untuk Cuti',
                'department_id' => '1',
                'user_id' => 1,
            ],
            
            [
                'name' => 'Surat Lembur',
                'description' => 'Untuk Lembur',
                'department_id' => 2,
                'user_id' => 1,
            ],
            [
                'name' => 'Surat Izin',
                'description' => 'Untuk Izin',
                'department_id' => 2,
                'user_id' => 1,
            ],
            [
                'name' => 'Surat Sakit',
                'description' => 'Untuk Sakit',
                'department_id' => 2,
                'user_id' => 1,
            ],
           
            [
                'name' => 'Surat Cuti',
                'description' => 'Untuk Cuti',
                'department_id' => 2,
                'user_id' => 1,
            ],
            [
                'name' => 'Surat Lembur',
                'description' => 'Untuk Lembur',
                'department_id' => 3,
                'user_id' => 1,
            ],
            [
                'name' => 'Surat Izin',
                'description' => 'Untuk Izin',
                'department_id' => 3,
                'user_id' => 1,
            ],
            [
                'name' => 'Surat Sakit',
                'description' => 'Untuk Sakit',
                'department_id' => 3,
                'user_id' => 1,
            ],
           
            [
                'name' => 'Surat Cuti',
                'description' => 'Untuk Cuti',
                'department_id' => 3,
                'user_id' => 1,
            ],
            
           
           
        ])->each(function ($letterType) {
            $letterType = LetterType::create($letterType);
        });
    }
}
