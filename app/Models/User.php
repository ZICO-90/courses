<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard = 'web';
    protected $fillable = [
        'username',
        'full_name',
        'phone',
        'email',
        'password',
        'gender',
        'is_work',
        'is_view',
        'country_id',
        'policyactivation',
        'email_verified',
        'avatar',
        'qualification',
        'Specialization',
        'Employment',
        'is_stop',
        'remember_token'
        
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
        'is_view' => 'json',
    ];





    public function Interests()
    {
    
      return $this->belongstoMany(Interest::class ,'user_interests')->withPivot('is_work')->withTimestamps();
    }

    public function courses() #-- subscribue users
    {
    
      return $this->belongstoMany(Course::class ,'user_cources' , 'student_id' , 'cource_id')->withPivot('is_work' ,'withdraw' ,'finished')->withTimestamps();
    }

    public function course_instructor()
    {
      return $this->hasMany(Course::class ,'instructor_id' ,'id');
    }

    public function biography()
    {
        return $this->hasOne(Biography::class,'instructor_id','id');
    }

    public function subscribes()
    {
        return $this->hasMany(UserCource::class,'student_id','id');
    }

 
    

    public function gateways()
    {
        return $this->hasMany(GatewayPayment::class,'student_id','id');
    }

    public function lessone_course()
    {
        return $this->hasMany(StudentLessonCource::class,'student_id','id');
    }


    public function scopeInstructor($query)
    {
      return $query->where('is_work',1)->orWhere('is_work' , 3);
    }

    public function comments()
    {
        return $this->hasMany(LessonComment::class,'student_id' ,'id');
    }

    public function reply()
    {
        return $this->hasMany(LessonReplyComment::class,'student_id' ,'id');
    }

    
    public function test_courses()
    {
      return $this->hasMany(TestCourse::class ,'student_id' ,'id');
    }
    public function test_courses_student()
    {
      return $this->hasOne(TestCourse::class ,'student_id' ,'id');
    }
}
