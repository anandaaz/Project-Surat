<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPerintahLembur extends Model
{
    use HasFactory;
    protected $table = 'surat_perintah_lemburs';
    protected $guarded = ['id'];

    public function created_by(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function department(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function letterType(){
        return $this->belongsTo(LetterType::class, 'letter_type_id', 'id');
    }

    public function surat_perintah_lembur_details(){
        return $this->hasMany(SuratPerintahLemburDetail::class);
    }
}
