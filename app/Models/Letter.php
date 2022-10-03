<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function letter_type(){
        return $this->belongsTo(LetterType::class, 'letter_type_id');
    }

    public function department(){
        return $this->belongsto(Department::class, 'department_id');
    }
}
