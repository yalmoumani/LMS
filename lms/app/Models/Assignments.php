<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    use HasFactory;

    protected $fillable = [
        "assignmentName",
        "assignmentDescription",
        "dueDate",
        "openDate",
        "courseID",
        "files",
    ];

    public function course(){
     $this->belongsTo(Courses::class);
    }
    public function AssignmentSubmissions(){
     $this->belongsTo(AssignmentSubmissions::class);
    }
}
