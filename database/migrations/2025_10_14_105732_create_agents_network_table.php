<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agents_network', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('code', 50)->unique();
            $table->foreignId('country_id')
                ->constrained('countries_network_agent')
                ->onDelete('cascade');
            $table->foreignId('city_id')
                ->constrained('cities_network_agent')
                ->onDelete('cascade');
            $table->text('address')->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('image', 255)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            $table->index(['country_id', 'city_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agents_network');
    }
};
