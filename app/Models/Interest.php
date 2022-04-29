<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function courses() 
    {
        return $this->hasMany(Course::class,'interest_id' ,'id')->with('coures_instructor' , 'coures_interest');
    }

}
