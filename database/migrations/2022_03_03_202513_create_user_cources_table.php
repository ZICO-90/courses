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
        Schema::create('user_cources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('cource_id')->constrained('courses')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('is_work' , ['2' ,'3'] )->comment('[ 2 > student , 3 > both = student and instructor ]');
            $table->char('withdraw', 1)->nullable();// نسحاب من الدوره
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
        Schema::dropIfExists('user_cources');
    }
};
