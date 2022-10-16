<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuratPertukaranHK;

class SuratPertukaranHKSeeder extends Seeder
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
                'tanggal_kerja_start_date' => '2022-10-11',
                'tanggal_kerja_end_date' => '2022-10-14',
                'jam_kerja_start_time' => '07:00:00',
                'jam_kerja_end_time' => '05:00:00',
                'jumlah_kerja' => 4,
                'kondisi_kerja' => 'Masuk',
                'tanggal_pertukaran_start_date' => '2022-10-15',
                'tanggal_pertukaran_end_date' => '2022-10-18',
                'jam_pertukaran_start_time' => '07:00:00',
                'jam_pertukaran_end_time' => '05:00:00',
                'jumlah_pertukaran' => 4,
                'kondisi_pertukaran' => 'Libur',
                'alasan' => 'mager',
                'letter_type_id' => 3,
                'user_id' => 2,
            ],
            [
                'section' => 'Digitalisasi',
                'tanggal_kerja_start_date' => '2022-10-11',
                'tanggal_kerja_end_date' => '2022-10-14',
                'jam_kerja_start_time' => '07:00:00',
                'jam_kerja_end_time' => '05:00:00',
                'jumlah_kerja' => 4,
                'kondisi_kerja' => 'Masuk',
                'tanggal_pertukaran_start_date' => '2022-10-15',
                'tanggal_pertukaran_end_date' => '2022-10-18',
                'jam_pertukaran_start_time' => '07:00:00',
                'jam_pertukaran_end_time' => '05:00:00',
                'jumlah_pertukaran' => 4,
                'kondisi_pertukaran' => 'Libur',
                'alasan' => 'mager',
                'letter_type_id' => 3,
                'user_id' => 3,
            ],
            [
                'section' => 'Digitalisasi',
                'tanggal_kerja_start_date' => '2022-10-11',
                'tanggal_kerja_end_date' => '2022-10-14',
                'jam_kerja_start_time' => '07:00:00',
                'jam_kerja_end_time' => '05:00:00',
                'jumlah_kerja' => 4,
                'kondisi_kerja' => 'Masuk',
                'tanggal_pertukaran_start_date' => '2022-10-15',
                'tanggal_pertukaran_end_date' => '2022-10-18',
                'jam_pertukaran_start_time' => '07:00:00',
                'jam_pertukaran_end_time' => '05:00:00',
                'jumlah_pertukaran' => 4,
                'kondisi_pertukaran' => 'Libur',
                'alasan' => 'mager',
                'letter_type_id' => 3,
                'user_id' => 4,
            ],
            
        ])->each(function ($SuratPertukaranHK) {
            $SuratPertukaranHK = SuratPertukaranHK::create($SuratPertukaranHK);
        });
    }
}
