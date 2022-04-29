<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCource extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'cource_id',
        'is_work',
        'withdraw', 
        'finished',   
    ];

    protected $hidden = [
        'withdraw',
    ];



    public function user_student()
    {
        return $this->belongsto(User::class,'student_id' ,'id');
    }

    public function user_studen_course()
    {
        return $this->belongsto(Course::class,'cource_id' ,'id');
    }
}
