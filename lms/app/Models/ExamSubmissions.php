<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSubmissions extends Model
{
    use HasFactory;
    protected $fillable = ["userID","examID","examsResponse","grade"];

    public function users(){
        $this->hasMany(User::class);
    }
    public function exams(){
        $this->hasMany(Exams::class);
    }

}
