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
        Schema::table('test_courses', function (Blueprint $table) {
            $table->boolean('certif_request')->after('allow_print')->default(0);
            $table->boolean('certif_receive')->after('certif_request')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_course', function (Blueprint $table) {
            $table->dropColumn('certif_request');
            $table->dropColumn('certif_receive');
        });
    }
};
