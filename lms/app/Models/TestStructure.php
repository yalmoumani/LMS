<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestStructure extends Model
{
    use HasFactory;
    protected $fillable = ["testID","testStructure"];

    public function tests(){
         $this->hasMany(Tests::class);
    }

}
