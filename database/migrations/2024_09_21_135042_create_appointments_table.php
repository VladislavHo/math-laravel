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
            $table->uuid('id')->primary(); // Изменяем на UUID
            $table->uuid('user_id'); // Убедитесь, что тип данных совпадает
            $table->date('date');
            $table->time('time')->default('00:00:00'); 
            $table->string('status')->default('pending');

            $table->index('user_id', 'user_idx');

            // Внешний ключ для user_id
            $table->foreign('user_id', 'user_fk')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();

            // Определите внешний ключ
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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