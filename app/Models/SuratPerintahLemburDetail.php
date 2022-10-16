<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPerintahLemburDetail extends Model
{
    use HasFactory;
    protected $table = 'surat_perintah_lembur_details';
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function surat_perintah_lembur(){
        return $this->belongsTo(SuratPerintahLembur::class, 'surat_perintah_lembur_id', 'id');
    }

}
