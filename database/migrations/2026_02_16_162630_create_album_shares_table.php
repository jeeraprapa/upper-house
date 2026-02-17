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
        Schema::create('album_shares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')->constrained()->cascadeOnDelete();

            $table->string('token', 80)->unique();          // ลิงก์แชร์
            $table->string('name')->nullable();             // ชื่อเล่นลิงก์ (เช่น VIP, Agent)
            $table->timestamp('expires_at')->nullable();    // หมดอายุ (ถ้าใช้)
            $table->timestamp('revoked_at')->nullable();    // ยกเลิก (revoke)

            $table->unsignedBigInteger('view_count')->default(0);
            $table->timestamp('last_viewed_at')->nullable();

            $table->foreignId('created_by')->nullable()
                  ->constrained('users')->nullOnDelete();

            $table->timestamps();

            $table->index(['album_id','revoked_at']);
            $table->index(['album_id','expires_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album_shares');
    }
};
