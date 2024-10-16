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
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->id()->primary();
            $table->uuid('user_id');
            $table->string('telegram_name')->nullable();
            $table->string('name')->nullable();
            $table->string('lastName')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('tasks')->nullable();
            $table->string('deadline')->nullable();
            $table->string('age')->nullable();
            $table->string('investment')->nullable();
            $table->index('user_id', 'user_idx_questionnaires');

            // Внешний ключ для user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->name('user_fk_questionnaires');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questionnaires');
    }
};
