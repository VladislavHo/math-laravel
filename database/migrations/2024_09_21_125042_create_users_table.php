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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('telegram_id')->unique();
            $table->string('name')->nullable();
            $table->string('lastName')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('tasks')->nullable();
            $table->string('deadline')->nullable();
            $table->string('plans')->nullable();
            $table->string('age')->nullable();
            $table->string('income')->nullable();
            $table->string('investment')->nullable();
            $table->boolean('is_pay')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('is_subscribed')->default(false);
            // $table->uuid('appointment_id')->nullable(); 
            $table->string('role')->default('user');


            // $table->index('appointment_id', 'user_appointment_idx');

            // $table->foreign('appointment_id', 'user_appointment_fk')
            //     ->references('id')->on('appointments');
            $table->timestamp("send_at")->nullable();

            $table->rememberToken();
            $table->timestamps();


        });

        // telegram_id: string | undefined
// name: string;
// lastName: string;
// phone: string
// email: string
// tasks: string
// deadline: string
// plans: string
// age: string
// income: string

        // Schema::create('password_reset_tokens', function (Blueprint $table) {
        //     $table->string('email')->primary();
        //     $table->string('token');
        //     $table->timestamp('created_at')->nullable();
        // });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};

