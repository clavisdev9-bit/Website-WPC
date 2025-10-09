<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        // 1️⃣ Tabel utama: contacts
        Schema::create('contacts', function (Blueprint $table) {
            $table->id(); // ID lokal (auto increment)
            $table->unsignedBigInteger('remote_id')->nullable()->unique(); // 🔹 ID dari API eksternal
            $table->string('contact_id')->nullable(); // ✅ diperbaiki jadi string
            $table->string('name');
            $table->string('street')->nullable();
            $table->string('street2')->nullable();
            $table->string('city')->nullable();
            $table->string('zip', 50)->nullable();
            $table->string('npwp', 100)->nullable();
            $table->string('your_business')->nullable();
            $table->string('job_position')->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('mobile', 50)->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('title', 100)->nullable();
            $table->string('language', 10)->nullable();
            $table->string('company_type', 50)->nullable();
            $table->timestamps();
        });

        // 2️⃣ Tabel relasi: contact_countries
        Schema::create('contact_countries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained('contacts')->onDelete('cascade');
            $table->integer('country_id')->nullable();
            $table->string('country_name', 100)->nullable();
            $table->timestamps();
        });

        // 3️⃣ Tabel relasi: contact_states
        Schema::create('contact_states', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained('contacts')->onDelete('cascade');
            $table->integer('state_id')->nullable();
            $table->string('state_name', 100)->nullable();
            $table->timestamps();
        });

        // 4️⃣ Tabel relasi: contact_tags
        Schema::create('contact_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained('contacts')->onDelete('cascade');
            $table->integer('tag_id')->nullable();
            $table->string('tag_name', 100)->nullable();
            $table->timestamps();
        });

        // 5️⃣ Opsional: log sinkronisasi
        Schema::create('contact_sync_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamp('sync_time')->useCurrent();
            $table->integer('total_records')->default(0);
            $table->string('status', 50)->default('success');
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Rollback migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_sync_logs');
        Schema::dropIfExists('contact_tags');
        Schema::dropIfExists('contact_states');
        Schema::dropIfExists('contact_countries');
        Schema::dropIfExists('contacts');
    }
};
