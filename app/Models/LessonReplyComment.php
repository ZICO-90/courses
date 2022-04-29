<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonReplyComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment_id',
        'student_id',
        'reply_comments',  
    ];


    public function comment()
    {
        return $this->belongsto(LessonComment::class,'comment_id' ,'id');
    }

    public function user()
    {
        return $this->belongsto(User::class,'student_id' ,'id');
    }


}
