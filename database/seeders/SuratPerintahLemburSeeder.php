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
                'section' => 'Digitalisasi',
                'jadwal_kerja' => '2022/09/25 07:08:00',
                'pekerjaan' => 'Consume API Youtube',
                'rencana_lembur_start' => '18:30:00',
                'rencana_lembur_to' => '20:30:00',
                'aktual_lembur_start' => '18:00:00',
                'aktual_lembur_to' => '20:00:00',
                'jumlah_lembur' => 2,
                'personal_check_jml' => 2,
                'personal_check_tul' => 2,
                'personal_check_ket' => 'Kerja, Kerja, Kerja, Kerja, Tipes!',
                'letter_type_id' => 6,
                'user_id' => 2,
            ],
            [
                'waktu' => '2022/09/25',
                'section' => 'Digitalisasi',
                'jadwal_kerja' => '2022/09/25 07:08:00',
                'pekerjaan' => 'Consume API Youtube',
                'rencana_lembur_start' => '18:30:00',
                'rencana_lembur_to' => '20:30:00',
                'aktual_lembur_start' => '18:00:00',
                'aktual_lembur_to' => '20:00:00',
                'jumlah_lembur' => 2,
                'personal_check_jml' => 2,
                'personal_check_tul' => 2,
                'personal_check_ket' => 'Kerja, Kerja, Kerja, Kerja, Tipes!',
                'letter_type_id' => 6,
                'user_id' => 3,
            ],
            [
                'waktu' => '2022/09/25',
                'section' => 'Digitalisasi',
                'jadwal_kerja' => '2022/09/25 07:08:00',
                'pekerjaan' => 'Consume API Youtube',
                'rencana_lembur_start' => '18:30:00',
                'rencana_lembur_to' => '20:30:00',
                'aktual_lembur_start' => '18:00:00',
                'aktual_lembur_to' => '20:00:00',
                'jumlah_lembur' => 2,
                'personal_check_jml' => 2,
                'personal_check_tul' => 2,
                'personal_check_ket' => 'Kerja, Kerja, Kerja, Kerja, Tipes!',
                'letter_type_id' => 6,
                'user_id' => 4,
            ],
        ])->each(function ($SuratPerintahLembur) {
            $SuratPerintahLembur = SuratPerintahLembur::create($SuratPerintahLembur);
        });
    }
}
