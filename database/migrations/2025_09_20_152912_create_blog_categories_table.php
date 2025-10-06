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
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true); // auto increment
            $table->string('name');                  // nama kategori
            $table->string('slug')->unique();        // url-friendly
            $table->text('description')->nullable(); // deskripsi kategori
            $table->boolean('is_active')->default(1);// aktif/nonaktif
            $table->timestamps();                    // created_at & updated_at
            $table->softDeletes();                   // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_categories');
    }
};
