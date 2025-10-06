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
        Schema::create('access_menus', function (Blueprint $table) {
            $table->unsignedBigInteger('id_access_menu', true); // auto increment
            $table->unsignedBigInteger('id_role');               // relasi ke roles
            $table->unsignedBigInteger('id_menu');               // relasi ke menus
            $table->timestamps();                                // created_at & updated_at
            $table->softDeletes();                               // deleted_at

            // Foreign key
            $table->foreign('id_role')->references('id_role')->on('roles')->onDelete('cascade');
            $table->foreign('id_menu')->references('id_menu')->on('menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_menus');
    }
};
