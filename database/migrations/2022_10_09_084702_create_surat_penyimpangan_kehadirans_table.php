<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratPenyimpanganKehadiransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_penyimpangan_kehadirans', function (Blueprint $table) {
            $table->id();
            $table->string('section');
            $table->string('jadwal_start')->nullable();
            $table->string('jadwal_end')->nullable();
            $table->enum('jenis_penyimpangan', ['Terlambat Hadir', 'Pulang Lebih Awal', 'Tidak Absen'])->nullable();
            $table->time('jam_masuk')->nullable();
            $table->time('jam_pulang')->nullable();
            $table->text('alasan');
            $table->string('evidence')->nullable();
            $table->foreignId('letter_type_id')->constrained('letter_types')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_penyimpangan_kehadirans');
    }
}
