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
        Schema::create('lesson_reply_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comment_id')->constrained('lesson_comments')->onUpdate('cascade')->onDelete('cascade');
            $table->text('reply_comments');
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
        Schema::dropIfExists('lesson_reply_comments');
    }
};
