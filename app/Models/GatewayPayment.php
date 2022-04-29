<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class GatewayPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'subscribe_id',
        'course_id',
        'InvoiceId',
        'InvoiceStatus',
        'PaymentCreatedDate',
        'PaymentId',
        'PaymentGateway',
    ];
}
