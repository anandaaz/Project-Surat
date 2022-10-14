<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratIzinMP extends Model
{
    use HasFactory;
    protected $table = 'surat_izin_m_p_s';
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function letterType(){
        return $this->belongsTo(LetterType::class, 'letter_type_id', 'id');
    }
}
