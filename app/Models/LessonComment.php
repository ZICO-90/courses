<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'lesson_id',
        'student_id',
        'comments',  
    ];

    public function replies()
    {
        return $this->hasMany(LessonReplyComment::class,'comment_id' ,'id')->with('user');
    }

    public function Lesson()
    {
        return $this->belongsto(Lesson::class,'lesson_id' ,'id');
    }

    public function user()
    {
        return $this->belongsto(User::class,'student_id' ,'id');
    }
}
