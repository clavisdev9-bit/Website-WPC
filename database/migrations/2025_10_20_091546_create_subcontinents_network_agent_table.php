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
        Schema::create('subcontinents_network_agent', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Contoh: Asia Tenggara, Asia Timur
            $table->string('code')->unique(); // Contoh: SEA, EAS
            $table->foreignId('continent_id')
                  ->constrained('continents_network_agent')
                  ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcontinents_network_agent');
    }
};
