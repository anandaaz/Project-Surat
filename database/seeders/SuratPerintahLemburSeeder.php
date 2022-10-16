<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuratPerintahLembur;

class SuratPerintahLemburSeeder extends Seeder
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
                'waktu' => '2022/09/25',
                'evidence' => 'test/test',
                'created_by' => 1,
                'letter_type_id' => 6,
                'department_id' => 2,
            ],
            [
                'waktu' => '2022/09/25',
                'evidence' => 'test/test',
                'created_by' => 1,
                'letter_type_id' => 6,
                'department_id' => 3,
            ],
            [
                'waktu' => '2022/09/25',
                'evidence' => 'test/test',
                'created_by' => 1,
                'letter_type_id' => 6,
                'department_id' => 4,
            ],
        ])->each(function ($SuratPerintahLembur) {
            $SuratPerintahLembur = SuratPerintahLembur::create($SuratPerintahLembur);
        });
    }
}
