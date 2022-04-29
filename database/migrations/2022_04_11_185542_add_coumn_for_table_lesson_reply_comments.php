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
        Schema::table('lesson_reply_comments', function (Blueprint $table) {
            $table->foreignId('student_id')->after('comment_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lesson_reply_comments', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropColumn('student_id');
        });
    }
};
