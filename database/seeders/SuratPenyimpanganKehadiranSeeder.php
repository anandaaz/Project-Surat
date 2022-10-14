<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuratPenyimpanganKehadiran;

class SuratPenyimpanganKehadiranSeeder extends Seeder
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
                'jadwal_start' => '2022/09/25',
                'jadwal_end' => '2022/09/28',
                'jenis_penyimpangan' => 'Terlambat Hadir',
                'jam_masuk' => '09:30:00',
                'alasan' => 'Kelamaan Rebahan',
                'letter_type_id' => 5,
                'user_id' => 2,
            ],
            
            [
                'section' => 'Digitalisasi',
                'jadwal_start' => '2022/09/25',
                'jadwal_end' => '2022/09/28',
                'jenis_penyimpangan' => 'Tidak Absen',
                'jam_masuk' => '09:30:00',
                'alasan' => 'Kelamaan Rebahan',
                'letter_type_id' => 5,
                'user_id' => 4,
            ],
            
            [
                'section' => 'Digitalisasi',
                'jadwal_start' => '2022/09/25',
                'jadwal_end' => '2022/09/28',
                'jenis_penyimpangan' => 'Pulang Lebih Awal',
                'jam_pulang' => '16:30:00',
                'alasan' => 'Kelamaan Rebahan',
                'letter_type_id' => 5,
                'user_id' => 3,
            ],
            
            
        ])->each(function ($SuratPenyimpanganKehadiran) {
            $SuratPenyimpanganKehadiran = SuratPenyimpanganKehadiran::create($SuratPenyimpanganKehadiran);
        });
    }
}
