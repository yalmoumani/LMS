<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quizzes extends Model
{
    use HasFactory;
    protected $fillable = [ "quizName","quizDescription","openTime",
    "closingTime",
    "duration",
    "courseID",
];
public function quizStructure(){
    $this->belongsTo(QuizStructure::class);
}
public function quizSubmissions(){
    $this->belongsTo(QuizSubmissions::class);
}
}
