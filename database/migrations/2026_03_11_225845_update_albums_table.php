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
        Schema::table('albums', function (Blueprint $table) {
            $table->timestamp('expires_at')->nullable()->after('published_at');
            $table->string('image_header')->nullable()->after('subtitle');
            $table->text('image_description')->nullable()->after('image_header');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('albums', function (Blueprint $table) {
            $table->dropColumn('expires_at');
            $table->dropColumn('image_header');
            $table->dropColumn('image_description');
        });
    }
};
