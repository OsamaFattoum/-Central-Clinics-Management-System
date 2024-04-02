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
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('number',7)->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->boolean('open_status')->default(1);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('clinic_translations', function (Blueprint $table) {
            // mandatory fields
            $table->id();
            $table->string('locale')->index();

            // Foreign key to the main model
            $table->unique(['clinic_id', 'locale']);
            $table->foreignId('clinic_id')->references('id')->on('clinics')->cascadeOnDelete();

            // Actual fields you want to translate
            $table->string('name',100)->unique();
            $table->text('description')->nullable();  
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinics');
        Schema::dropIfExists('clinic_translations');
    }
};
