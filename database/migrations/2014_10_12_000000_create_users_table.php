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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('full_name');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('qualification')->nullable();
            $table->string('Specialization')->nullable();
            $table->string('Employment')->nullable(); //email_verified
            $table->boolean('email_verified')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('gender')->comment('[ 1 > male , 2 > female ]')	;
            $table->enum('is_work' , ['1' , '2' ,'3'] )->comment('[ 1 > instructor , 2 > student , 3 > both ]');
            $table->json('is_view')->nullable();
            $table->unsignedBigInteger('country_id');  // column reference after  migrate this one
            $table->boolean('policyactivation')->comment('[ 1 > agree required '); // agree required is stop
            $table->boolean('is_stop')->default(0)->comment('[ 0 un stop  , 1 > is stop training ');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
