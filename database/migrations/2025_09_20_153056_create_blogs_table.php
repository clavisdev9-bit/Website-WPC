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
        Schema::create('blogs', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);   // auto increment
            $table->string('title');                   // judul blog/news
            $table->string('slug')->unique();          // url-friendly
            $table->longText('content');               // isi artikel
            $table->text('excerpt')->nullable();       // ringkasan artikel
            $table->unsignedBigInteger('author_id');   // relasi ke users
            $table->unsignedBigInteger('category_id')->nullable(); // kategori
            $table->string('image')->nullable();       // gambar utama
            $table->boolean('is_published')->default(false); // status publish
            $table->timestamp('published_at')->nullable();     // tanggal publish
            $table->integer('views')->default(0);      // jumlah view
            $table->string('meta_title')->nullable();  // SEO meta title
            $table->text('meta_description')->nullable(); // SEO meta description
            $table->timestamps();                      // created_at & updated_at
            $table->softDeletes();                     // deleted_at

            // Foreign keys
            // $table->foreign('author_id')->references('id_user')->on('ms_users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('blog_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
