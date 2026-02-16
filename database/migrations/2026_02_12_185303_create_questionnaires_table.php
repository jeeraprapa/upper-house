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
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->id();

            // UNIT OF INTEREST (เก็บเป็น JSON)
            $table->json('unit_interest')->nullable();

            // CONTACT DETAILS
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable()->index();
            $table->string('contact_number', 50)->nullable();
            $table->string('country_of_residence')->nullable();
            $table->text('remark')->nullable();

            // CONSENT
            $table->boolean('consent_transfer')->default(false);
            $table->boolean('consent_citydynamic_marketing')->default(false);
            $table->boolean('consent_affiliate_marketing')->default(false);

            // SIGNATURE
            $table->string('signature')->nullable();
            $table->string('printed_name')->nullable();
            $table->date('signed_date')->nullable();

            // optional: ใครกรอก (ถ้าเป็น admin login)
            $table->foreignId('created_by')->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questionnaires');
    }
};
