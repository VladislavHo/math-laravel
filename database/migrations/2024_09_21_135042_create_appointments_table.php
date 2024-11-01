<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->uuid('id')->primary(); 
            $table->uuid('user_id'); 
            $table->date('date');
            $table->time('time')->default('00:00:00'); 
            $table->string('status')->default('pending');
            $table->index('user_id', 'user_idx_appointment');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->name('user_fk_appointment');

            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
