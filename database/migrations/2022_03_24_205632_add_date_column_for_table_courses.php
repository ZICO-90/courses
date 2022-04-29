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
         
            $table->date('start_date')->format('YYYY-MM-DD')->after('url_type');
            $table->date('end_date')->format('YYYY-MM-DD')->after('start_date');
            
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
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
            

        });
    }
};
