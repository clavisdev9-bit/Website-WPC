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
        Schema::create('app_settings_frontend', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);    // auto increment
            $table->string('app_name');
            $table->string('logo_path')->nullable();
            $table->string('version')->nullable();
            $table->string('copyright')->nullable();
            $table->string('year')->nullable();
            $table->string('company_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();                       // created_at & updated_at
            $table->softDeletes();                      // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_settings_frontend');
    }
};
