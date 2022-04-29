<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'cource_id',
    ];

    public function course()
    {
        return $this->belongsto(Course::class,'cource_id' ,'id');
    }

    public function QuestionAnswers()
    {
        return $this->hasMany(QuestionAnswer::class,'question_id' ,'id');
    }
}
