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
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')->constrained()->cascadeOnDelete();

            $table->string('image_path'); // storage path
            $table->string('caption')->nullable();
            $table->unsignedInteger('sort_order')->default(0);

            $table->boolean('is_published')->default(true);
            $table->timestamp('taken_at')->nullable();

            $table->timestamps();

            $table->index(['album_id', 'is_published', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
