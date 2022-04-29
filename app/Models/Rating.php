<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{  
    use HasFactory;

    protected $fillable = [
        'student_id',
        'cource_id',
        'star',
    ];

    public function coures()
    {
        return $this->belongsto(Course::class,'cource_id' ,'id');
    }

    public function User()
    {
        return $this->belongsto(User::class,'student_id' ,'id');
    }
}
