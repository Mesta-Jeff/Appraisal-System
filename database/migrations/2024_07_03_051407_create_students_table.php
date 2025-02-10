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
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(5000);
            $table->string('student_number', 15);
            $table->string('initials', 10)->nullable();
            $table->foreignId('programme_id')->constrained()->onDelete('cascade');
            $table->foreignId('class_id')->constrained()->onDelete('cascade');
            $table->string('first_name', 50);
            $table->string('middle_name', 50)->nullable();
            $table->string('last_name', 100);
            $table->string('gender', 10);
            $table->date('dob')->nullable();
            $table->string('phone', 10)->unique();
            $table->string('email', 100)->unique();
            $table->string('profile')->nullable();
            $table->string('status', 10)->default('Active');
            $table->timestamps();
            $table->string('is_completed', 3)->default('No');
            $table->date('year_completed')->nullable();
            $table->string('is_deleted', 3)->default('No');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
