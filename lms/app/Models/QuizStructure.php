<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizStructure extends Model
{
    use HasFactory;
    protected $fillable = ["quizID","quizStructure"];

    public function quizzes(){
        $this->hasMany(Quizzes::class,"quizID");
    }
}
