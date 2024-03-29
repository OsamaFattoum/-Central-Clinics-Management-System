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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('scientific_name',30);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('department_translations', function (Blueprint $table) {
            // mandatory fields
            $table->id();
            $table->string('locale')->index();

            // Foreign key to the main model
            $table->unique(['department_id', 'locale']);
            $table->foreignId('department_id')->references('id')->on('departments')->cascadeOnDelete();

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
        Schema::dropIfExists('departments');
        Schema::dropIfExists('department_translations');
    }
};
