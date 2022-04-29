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
        Schema::table('courses', function (Blueprint $table) {
            $table->renameColumn('price', 'course_price');
            $table->renameColumn('case_payment', 'case_payment_course');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) { 
            $table->renameColumn('course_price', 'price');
            $table->renameColumn('case_payment_course', 'case_payment');
        });
    }
};
