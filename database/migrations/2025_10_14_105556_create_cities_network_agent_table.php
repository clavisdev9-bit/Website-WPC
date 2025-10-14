<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cities_network_agent', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')
                ->constrained('countries_network_agent')
                ->onDelete('cascade');
            $table->string('name', 100);
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();
            $table->timestamps();

            $table->index('country_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cities_network_agent');
    }
};
