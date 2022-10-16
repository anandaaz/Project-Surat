<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuratPerintahLemburDetail;

class SuratPerintahLemburDetailSeeder extends Seeder
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
                'surat_perintah_lembur_id' => 1,
                'section' => 'Digitalisasi',
                'pekerjaan' => 'Consume API Youtube',
                'jadwal_kerja_start' => '07:00:00',
                'jadwal_kerja_to' => '17:00:00',
                'rencana_lembur_start' => '18:30:00',
                'rencana_lembur_to' => '20:30:00',
                'aktual_lembur_start' => '18:00:00',
                'aktual_lembur_to' => '20:00:00',
                'jumlah_lembur' => 2,
                'personal_check_jml' => 2,
                'personal_check_tul' => 4,
                'personal_check_ket' => 'Kerja, Kerja, Kerja, Kerja, Tipes!',
                'user_id' => 2,
            ],
            [
                'surat_perintah_lembur_id' => 2,
                'section' => 'Digitalisasi',
                'pekerjaan' => 'Consume API Youtube',
                'jadwal_kerja_start' => '07:00:00',
                'jadwal_kerja_to' => '17:00:00',
                'rencana_lembur_start' => '18:30:00',
                'rencana_lembur_to' => '20:30:00',
                'aktual_lembur_start' => '18:00:00',
                'aktual_lembur_to' => '20:00:00',
                'jumlah_lembur' => 2,
                'personal_check_jml' => 2,
                'personal_check_tul' => 4,
                'personal_check_ket' => 'Kerja, Kerja, Kerja, Kerja, Tipes!',
                'user_id' => 3,
            ],
            [
                'surat_perintah_lembur_id' => 3,
                'section' => 'Digitalisasi',
                'pekerjaan' => 'Consume API Youtube',
                'jadwal_kerja_start' => '07:00:00',
                'jadwal_kerja_to' => '17:00:00',
                'rencana_lembur_start' => '18:30:00',
                'rencana_lembur_to' => '20:30:00',
                'aktual_lembur_start' => '18:00:00',
                'aktual_lembur_to' => '20:00:00',
                'jumlah_lembur' => 2,
                'personal_check_jml' => 2,
                'personal_check_tul' => 4,
                'personal_check_ket' => 'Kerja, Kerja, Kerja, Kerja, Tipes!',
                'user_id' => 4,
            ],
            
        ])->each(function ($SuratPerintahLemburDetail) {
            $SuratPerintahLemburDetail = SuratPerintahLemburDetail::create($SuratPerintahLemburDetail);
        });
    }
}
