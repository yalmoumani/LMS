<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;
    protected $fillable = [
        "id","courseName","courseDescription","courseImg","section","semester","teacherID",
    ];

    public function id()
    {
        return $this->belongsToMany(Exams::class);
    }
    public function students()
    {
        return $this->hasMany(User::class,'courses_users','courseID','userID');
    }
    public function assigments()
    {
        return $this->hasMany(Assignments::class);
    }
    public function semester(){
        $this->belongsToMany(Semester::class);
}
    public function speciality(){
        $this->belongsToMany(Speciality::class);
}
    public function quizzes(){
        $this->belongsToMany(Quizzes::class);
}
    public function tests(){
        $this->belongsToMany(Tests::class);
}
}
