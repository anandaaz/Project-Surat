<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPermohonSCP extends Model
{
    use HasFactory;
    protected $table = 'surat_permohon_s_c_p_s';
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function letterType(){
        return $this->belongsTo(LetterType::class, 'letter_type_id', 'id');
    }
}
