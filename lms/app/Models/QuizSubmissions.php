<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizSubmissions extends Model
{
    use HasFactory;
    protected $fillable = ["userID","quizID","quizSubmission","grade"];

    public function users(){
       $this->hasMany(User::class);
    }

    public function quizzes(){
       $this->hasMany(Quizzes::class);
    }
}
