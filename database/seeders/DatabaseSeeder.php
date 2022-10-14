<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DepartmentSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            LetterTypeSeeder::class,
            SuratCutiSeeder::class,
            SuratIzinMPSeeder::class,
            SuratPertukaranHKSeeder::class,
            SuratPermohonanSCPSeeder::class,
            SuratPenyimpanganKehadiranSeeder::class,
            SuratPerintahLemburSeeder::class,
        ]);
    }
}
