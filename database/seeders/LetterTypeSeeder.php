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
                'name' => 'Form Izin Meninggalkan Pekerjaan',
                'description' => 'Izin Meninggalkan Pekerjaan',
                'user_id' => 1,
            ],
            [
                'name' => 'Form Cuti/ Izin Khusus',
                'description' => 'Izin Khusus',
                'user_id' => 1,
            ],
            [
                'name' => 'Form Pertukaran Hari Kerja',
                'description' => 'Pertukaran hari Kerja',
                'user_id' => 1,
            ],
           
            [
                'name' => 'Form Permohonan Saldo Cuti Pengganti',
                'description' => 'Permohonan Saldo Cuti Pengganti',
                'user_id' => 1,
            ],
            [
                'name' => 'Form Penyimpangan Kehadiran',
                'description' => 'Penyimpangan Kehadiran',
                'user_id' => 1,
            ],
            [
                'name' => 'Form Perintah Kerja Lembur',
                'description' => 'Perintah Kerja Lembur',
                'user_id' => 1,
            ],
        ])->each(function ($letterType) {
            $letterType = LetterType::create($letterType);
        });
    }
}
