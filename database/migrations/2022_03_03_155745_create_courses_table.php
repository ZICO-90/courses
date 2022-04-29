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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instructor_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('interest_id')->constrained('interests')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title');
            $table->text('details');
            $table->decimal('price' ,6,0)->default(0); 
            $table->boolean('case_payment')->default(0); 
            $table->json('is_subscribe');
            $table->string('url')->comment('External link > 0  or upload file > 1');
            $table->boolean('url_type')->default(0); 
            $table->boolean('is_activation')->comment('Content approval with admin')->default(0); 
            $table->json('previous_requirement')->nullable();
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
        Schema::dropIfExists('courses');
    }
};
