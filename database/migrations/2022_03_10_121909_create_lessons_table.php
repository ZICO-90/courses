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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('detalis',65535);
            $table->string('url_video');
            $table->boolean('url_type')->default(0); // رفع فيديو من جهاز او من اليوتيوب    
            $table->string('external_link_file')->nullable();
            $table->integer('sort_display_video');
            $table->foreignId('cource_id')->constrained('courses')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('lessons');
    }
};
