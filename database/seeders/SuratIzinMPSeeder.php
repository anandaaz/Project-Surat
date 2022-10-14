<?php

namespace Database\Seeders;

use App\Models\SuratIzinMP;
use Illuminate\Database\Seeder;

class SuratIzinMPSeeder extends Seeder
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
                'berangkat' => NOW(),
                'kembali' => NOW(),
                'keperluan' => 'Males Kerja Karena Mageran',
                'letter_type_id' => 1,
                'user_id' => 2,
            ],
            [
                'section' => 'Digitalisasi',
                'berangkat' => NOW(),
                'kembali' => NOW() ,
                'keperluan' => 'Males Kerja Karena Mageran',
                'letter_type_id' => 1,
                'user_id' => 3,
            ],
            [
                'section' => 'Digitalisasi',
                'berangkat' => NOW(),
                'kembali' => NOW() ,
                'keperluan' => 'Males Kerja Karena Mageran',
                'letter_type_id' => 1,
                'user_id' => 4,
            ],
        ])->each(function ($SuratIzinMP) {
            $SuratIzinMP = SuratIzinMP::create($SuratIzinMP);
        });
    }
}
