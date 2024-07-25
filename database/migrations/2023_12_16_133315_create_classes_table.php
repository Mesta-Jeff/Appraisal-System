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
        Schema::create('classes', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(1500);
            // $table->foreignId('programme_id')->constrained()->onDelete('cascade');
            $table->string('class')->unique();
            $table->text('description')->default('No Description');
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
        Schema::dropIfExists('classes');
    }
};
