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
            $table->foreignId('record_id')->references('id')->on('records')->cascadeOnDelete();
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
