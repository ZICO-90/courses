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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('reference_certif');
            $table->decimal('certifi_price' ,6,0)->default(0); 
            $table->boolean('case_payment')->default(0); 
            $table->boolean('is_active_print')->default(0);
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
        Schema::dropIfExists('certificates');
    }
};
