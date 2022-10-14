<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPerintahLembur extends Model
{
    use HasFactory;
    protected $table = 'surat_perintah_lemburs';
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function letterType(){
        return $this->belongsTo(LetterType::class, 'letter_type_id', 'id');
    }
}
