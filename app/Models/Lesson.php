<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
   
    use HasFactory;

    protected $fillable = [
        'name',
        'detalis',
        'url_video',
        'url_type',
        'time' ,
        'external_link_file',
        'sort_display_video',
        'cource_id', 
        
    ];
    protected $appends = ['youtube_id'];

    
    public function comments()
    {
        return $this->hasMany(LessonComment::class,'lesson_id' ,'id')->with( 'user' , 'replies');
    }



    
    public function getYoutubeIdAttribute()
    {
        if($this->url_type == 0)
        {
            $positionStart = strrpos($this->url_video, 'v=')+2;
            $positionEnd = strrpos($this->url_video, '&' , $positionStart);
            $youtube_id = substr( $this->url_video , $positionStart , ( strlen($this->url_video) - $positionEnd) );
            
            return   $youtube_id ;
        }
    }

    public function student_lessone_course()
    {
        return $this->hasMany(StudentLessonCource::class,'lesson_id','id');
    }

}
