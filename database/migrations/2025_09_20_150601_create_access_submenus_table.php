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
        Schema::create('access_submenus', function (Blueprint $table) {
            $table->unsignedBigInteger('id_access_submenu', true); // auto increment
            $table->unsignedBigInteger('id_user');                  // relasi ke users
            $table->unsignedBigInteger('id_submenu');               // relasi ke submenus
            $table->timestamps();                                   // created_at & updated_at
            $table->softDeletes();                                  // deleted_at

            // Foreign key
            // $table->foreign('id_user')->references('id_user')->on('ms_users')->onDelete('cascade');
            $table->foreign('id_submenu')->references('id_submenu')->on('submenus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_submenus');
    }
};
