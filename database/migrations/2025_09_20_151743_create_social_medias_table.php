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
        Schema::create('social_medias', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);   // auto increment
            $table->unsignedBigInteger('app_setting_id'); // id app setting (tanpa relasi)
            $table->string('platform');               // nama platform
            $table->string('url');                    // link sosial media
            $table->string('icon')->nullable();       // icon path/class
            $table->timestamps();                      // created_at & updated_at
            $table->softDeletes();                     // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_medias');
    }
};
