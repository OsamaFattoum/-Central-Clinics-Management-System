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
        Schema::create('medications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->references('id')->on('departments')->cascadeOnDelete();
            $table->foreignId('case_type_id')->references('id')->on('case_types')->cascadeOnDelete();
            $table->foreignId('patient_id')->references('id')->on('patients')->cascadeOnDelete();
            $table->string('name',100);
            $table->string('dosage',100);
            $table->text('instructions');
            $table->boolean('medication_taken')->default(0);
            $table->boolean('has_alternative')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medications');
    }
};
