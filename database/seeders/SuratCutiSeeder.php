<?php

namespace Database\Seeders;

use App\Models\SuratCuti;
use Illuminate\Database\Seeder;

class SuratCutiSeeder extends Seeder
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
                'section' => 'Digitalisasi',
                'lama_cuti' => 30,
                'cuti_start_date' => '2022/09/25',
                'cuti_end_date' => '2022/10/25',
                'keperluan' => 'Males Kerja Karena Mageran',
                'kategori_cuti' => 'Cuti Melahirkan',
                'saldo_cuti' => 10000,
                'catatan' => 'Ini Catatan',
                'letter_type_id' => 2,
                'user_id' => 2,
            ],
            [
                'section' => 'Digitalisasi',
                'lama_cuti' => 30,
                'cuti_start_date' => '2022/09/25',
                'cuti_end_date' => '2022/10/25',
                'keperluan' => 'Males Kerja Karena Mageran',
                'kategori_cuti' => 'Cuti Melahirkan',
                'saldo_cuti' => 10000,
                'catatan' => 'Ini Catatan',
                'letter_type_id' => 2,
                'user_id' => 3,
            ],
            [
                'section' => 'Digitalisasi',
                'lama_cuti' => 30,
                'cuti_start_date' => '2022/09/25',
                'cuti_end_date' => '2022/10/25',
                'keperluan' => 'Males Kerja Karena Mageran',
                'kategori_cuti' => 'Cuti Melahirkan',
                'saldo_cuti' => 10000,
                'catatan' => 'Ini Catatan',
                'letter_type_id' => 2,
                'user_id' => 4,
            ],
            
        ])->each(function ($SuratCuti) {
            $SuratCuti = SuratCuti::create($SuratCuti);
        });
    }
}
