<?php

use Illuminate\Support\Facades\DB;
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
            $table->id();
            $table->bigInteger('role_id')->unsigned();
            $table->string('permission')->unique();
            $table->string('permission_key')->unique();
            $table->string('description')->nullable();
            $table->string('hook')->nullable();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });

        DB::statement('ALTER TABLE permissions AUTO_INCREMENT = 2500');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
