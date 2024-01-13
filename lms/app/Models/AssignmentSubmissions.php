<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSubmissions extends Model
{
    use HasFactory;
    protected $fillable = ["userID","assignmentID","files","grade"];

    public function user(){
        $this->hasMany(User::class);
    }
    public function assignments(){
        $this->hasMany(Assignments::class);
    }
}

