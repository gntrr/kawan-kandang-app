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
        Schema::create('rule_gejala', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rule_id');
            $table->unsignedBigInteger('gejala_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('rule_id')->references('id_rule')->on('rules')->onDelete('cascade');
            $table->foreign('gejala_id')->references('id_gejala')->on('gejala')->onDelete('cascade');
            
            // Unique constraint to prevent duplicate entries
            $table->unique(['rule_id', 'gejala_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rule_gejala');
    }
};