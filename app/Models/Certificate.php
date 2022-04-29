<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{

    use HasFactory;
    protected $fillable = [
        'name',
        'reference_certif',
        'certifi_price',
        'case_payment',
        'is_active_print',
        'cource_id',
     
        
    ];

    protected $hidden = [
        'is_active_print',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class ,'cource_id' ,'id');
    }
}
