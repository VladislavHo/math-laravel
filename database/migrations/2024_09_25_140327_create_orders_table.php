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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('payment_name');
            $table->string('status');
            $table-> date("date_payment")->nullable();
            $table->index('user_id', 'user_idx_order');

            // Внешний ключ для user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->name('user_fk_order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
