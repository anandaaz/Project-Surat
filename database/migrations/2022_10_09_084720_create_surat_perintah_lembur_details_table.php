<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratPerintahLemburDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_perintah_lembur_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_perintah_lembur_id')->constrained('surat_perintah_lemburs')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('section')->nullable();
            $table->text('pekerjaan')->nullable();
            $table->time('jadwal_kerja_start')->nullable();
            $table->time('jadwal_kerja_to')->nullable();
            $table->time('rencana_lembur_start')->nullable();
            $table->time('rencana_lembur_to')->nullable();
            $table->time('aktual_lembur_start')->nullable();
            $table->time('aktual_lembur_to')->nullable();
            $table->unsignedBigInteger('jumlah_lembur')->nullable();
            $table->unsignedBigInteger('personal_check_jml')->nullable();
            $table->unsignedBigInteger('personal_check_tul')->nullable();
            $table->text('personal_check_ket')->nullable();
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
        Schema::dropIfExists('surat_perintah_lembur_details');
    }
}
