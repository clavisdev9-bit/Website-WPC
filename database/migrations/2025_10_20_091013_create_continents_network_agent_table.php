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
        Schema::create('continents_network_agent', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Contoh: Asia, Eropa
            $table->string('code')->unique(); // Contoh: AS, EU
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('continents_network_agent');
    }
};
