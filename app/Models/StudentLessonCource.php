<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentLessonCource extends Model
{

    use HasFactory;
    protected $fillable = [
        'lesson_id',
        'student_id',
        'cource_id',
    ];


    public function student_lesson()
    {
        return $this->belongsto(User::class,'student_id' ,'id'); 
    }


    public function student_course()
    {
        return $this->belongsto(Course::class,'cource_id' ,'id'); 
    }


    public function scopeStudentEndLesson($query ,$OneWeher ,$TwoWhere)
    {
        return $query->where('lesson_id' ,$OneWeher )->where('cource_id' ,$TwoWhere)->first();
    }



}
