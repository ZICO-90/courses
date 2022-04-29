<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  
    public function up()
    {
        Schema::create('gateway_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('subscribe_id')->constrained('user_cources')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('course_id') ;
            $table->unsignedBigInteger('InvoiceId') ;
            $table->string('InvoiceStatus') ;
            $table->dateTime('PaymentCreatedDate') ;
            $table->string('PaymentId') ;
            $table->string('PaymentGateway') ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gateway_payments');
    }
};
