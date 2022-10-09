<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratCutisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_cutis', function (Blueprint $table) {
            $table->id();
            $table->string('section');
            $table->unsignedSmallInteger('lama_cuti');
            $table->timestamp('cuti_start_date');
            $table->timestamp('cuti_end_date');
            $table->text('keperluan');
            $table->enum('kategori_cuti', [
                'Cuti Tahunan', 
                'Cuti 5 Tahunan',
                'Cuti Pengganti',
                'Cuti Haid',
                'Cuti Melahirkan',
                'Cuti Menikah',
            ]);
            $table->unsignedDouble('saldo_cuti');
            $table->text('catatan');
            $table->string('evidence')->nullable();
            $table->string('tanggal_evidence')->nullable();
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
        Schema::dropIfExists('surat_cutis');
    }
}
