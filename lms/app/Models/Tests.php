<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tests extends Model
{
    use HasFactory;
    protected $fillable = [ "testName","testDescription","openTime",
    "closingTime",
    "duration",
    "courseID",
];
public function testStructure(){
    $this->belongsToMany(TestStructure::class);
 }
public function courses(){
    $this->hasMany(Courses::class);
 }
}
