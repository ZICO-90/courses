<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biography extends Model
{
    use HasFactory;
    protected $fillable = [
        'instructor_id',
        'biography',
        'biography_link',
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class,'instructor_id','id')->where('is_work','=',2)->orWhere('is_work' ,'=', 3);
    }
}
