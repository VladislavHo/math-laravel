<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('analytics', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->boolean('is_leanding')->default(false);

            $table->boolean('is_article')->default(false);
            $table->boolean('is_questionnaires')->default(false);
            $table->boolean('is_questionnaires_passed')->default(false);


            $table->boolean('is_calendar')->default(false);
            $table->boolean('is_calendar_passed')->default(false);


            $table->boolean('consultation_conducted')->default(false);
            $table->index('user_id', 'user_idx_analytics');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->name('user_fk_analytics');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analytics');
    }
};
