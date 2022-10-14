<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuratPermohonSCP;

class SuratPermohonanSCPSeeder extends Seeder
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
                'jumlah_hari' => 10,
                'alasan' => 'mager',
                'letter_type_id' => 4,
                'user_id' => 2,
            ],
            [
                'section' => 'Digitalisasi',
                'jumlah_hari' => 10,
                'alasan' => 'mager',
                'letter_type_id' => 4,
                'user_id' => 3,
            ],
            [
                'section' => 'Digitalisasi',
                'jumlah_hari' => 10,
                'alasan' => 'mager',
                'letter_type_id' => 4,
                'user_id' => 4,
            ],
            
        ])->each(function ($SuratPermohonSCP) {
            $SuratPermohonSCP = SuratPermohonSCP::create($SuratPermohonSCP);
        });
    }
}
