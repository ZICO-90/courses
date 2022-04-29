<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    use HasFactory;
    protected $fillable = [
        'answer',
        'true_false',
        'question_id',
    ];

    public function question()
    {
        return $this->belongsto(Question::class,'question_id' ,'id');
    }
}
