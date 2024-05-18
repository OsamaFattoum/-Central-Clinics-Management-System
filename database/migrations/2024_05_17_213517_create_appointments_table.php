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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->references('id')->on('patients')->cascadeOnDelete();
            $table->foreignId('clinic_id')->references('id')->on('clinics')->cascadeOnDelete();
            $table->foreignId('department_id')->references('id')->on('departments')->cascadeOnDelete();
            $table->foreignId('doctor_id')->references('id')->on('doctors')->cascadeOnDelete();
            $table->text('notes')->nullable();
            $table->date('date');
            $table->time('time');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
