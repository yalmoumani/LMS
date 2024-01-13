<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
    use HasFactory;
    protected $fillable = ["examName", "examDescription","startDate","closingDate","duration","examType","courseID"
        ];
 /**
  * Get all of the comments for the Exams
  *
  * @return \Illuminate\Database\Eloquent\Relations\HasMany
  */
  public function courses()
    {
        return $this->hasMany(Courses::class, 'id', 'courseID');
    }
}
