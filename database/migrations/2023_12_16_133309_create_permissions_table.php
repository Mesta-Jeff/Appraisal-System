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
        Schema::create('permissions', function (Blueprint $table) 
        {
            $table->bigIncrements('id')->startingValue(2500);
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->string('permission')->unique();
            $table->string('permission_key')->unique();
            $table->text('description')->default('No Description');
            $table->string('hook')->nullable();
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
        Schema::dropIfExists('permissions');
    }
};
