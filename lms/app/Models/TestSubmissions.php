<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSubmissions extends Model
{
    use HasFactory;
    protected $fillable = ["userID","testID","testResponse"];

    public function users(){
       $this->hasMany(User::class);
    }
    public function tests(){
       $this->hasMany(Tests::class);
    }

}
