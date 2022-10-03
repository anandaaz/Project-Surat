<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function users(){
        return $this->hasMany(User::class, 'department_id', 'id');
    }
    
    public function letter_types(){
        return $this->hasMany(LetterType::class, 'department_id', 'id');
    }
}
