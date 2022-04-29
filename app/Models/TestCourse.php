<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestCourse extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'cource_id',
        'true',
        'false',
        'question',
        'details_answer',
        'allow_print',
        'certif_request',
        'certif_receive',
    ];
  
    protected $casts = [
        
        'details_answer' => 'json',
    ];
    public function student()
    {
        return $this->belongsto(User::class,'student_id' ,'id'); 
    }

    public function course()
    {
        return $this->belongsto(Course::class,'cource_id' ,'id'); 
    }
    

 

}
