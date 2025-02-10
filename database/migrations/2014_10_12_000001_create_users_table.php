<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(56000);
            $table->foreignId('role_id')->constrained()->nullable()->onDelete('cascade');
            $table->unsignedBigInteger('referer_id')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_first_time')->default(true);
            $table->boolean('default_password')->default(true);
            $table->integer('otp')->nullable();
            $table->string('token', 255)->nullable();
            $table->string('status', 15)->default('Active');
            $table->string('is_deleted', 3)->default('No');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('loginsessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->date('date');
            $table->string('time_in', 13)->nullable();
            $table->string('time_out', 13)->nullable();
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
        Schema::dropIfExists('loginsessions');
    }
};
