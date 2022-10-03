<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterType extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function letters(){
        return $this->hasMany(Letter::class, 'letter_type_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
