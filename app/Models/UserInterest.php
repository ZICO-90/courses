<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInterest extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'interest_id',
        'is_work',
    ];

    public function user()
    {
        return $this->belongsto(User::class,'user_id' ,'id');
    }

    public function Interest()
    {
        return $this->belongsto(Interest::class,'interest_id' ,'id');
    }

}
