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
        Schema::create('lecturers', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(1000);
            $table->string('staff_id', 15)->unique()->nullable();
            $table->string('title', 15);
            $table->string('initials', 10)->nullable();
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->string('first_name', 50);
            $table->string('last_name', 150);
            $table->string('gender', 10);
            $table->date('dob')->nullable();
            $table->string('phone', 10)->unique();
            $table->string('email', 100)->unique();
            $table->string('profile')->nullable();
            $table->string('status', 10)->default('Active');
            $table->timestamps();
            $table->string('is_deleted', 3)->default('No');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecturers');
    }
};
