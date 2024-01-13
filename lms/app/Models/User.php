<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'emergencyContact',
        'dob',
        'password',
        'userImg',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function  user(){
        return $this->belongsToMany(Courses::class,'courses_users','courseID','userID');
    }
    public function  roles(){
        return $this->belongsToMany(Roles::class, 'roles_users','roleID','userID');
    }
    public function  quizSubmissions(){
        return $this->belongsToMany(QuizSubmissions::class);
    }
    public function  assignmentSubmissions(){
        return $this->belongsToMany(AssignmentSubmissions::class);
    }
    public function  examSubmissions(){
        return $this->belongsToMany(ExamSubmissions::class);
    }
    public function  testSubmissions(){
        return $this->belongsToMany(TestSubmissions::class);
    }
}
