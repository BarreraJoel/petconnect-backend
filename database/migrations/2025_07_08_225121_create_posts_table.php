<?php

use App\Enums\Api\v1\PostTypeEnum;
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
        Schema::create('posts', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->enum('type', PostTypeEnum::toArray());
            $table->string('title');
            $table->string('city');
            $table->string('locality');
            $table->string('image_url')->nullable();
            $table->string('description');
            $table->boolean('is_approved')->default(false);
            $table->foreignUuid('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
