<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('countries_network_agent', function (Blueprint $table) {
            $table->id();

            // Data dasar negara
            $table->string('name', 100);
            $table->string('iso_code', 10)->unique();
            $table->string('flag')->nullable(); // path ke file bendera
            // Relasi ke sub-benua (opsional)
            $table->foreignId('subcontinent_id')
                  ->nullable()
                  ->constrained('subcontinents_network_agent')
                  ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('countries_network_agent');
    }
};
