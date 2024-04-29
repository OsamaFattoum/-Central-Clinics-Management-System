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
        Schema::create('case_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->references('id')->on('departments')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('case_type_translations', function (Blueprint $table) {
            // mandatory fields
            $table->id();
            $table->string('locale')->index();

            // Foreign key to the main model
            $table->unique(['case_type_id', 'locale']);
            $table->foreignId('case_type_id')->references('id')->on('case_types')->cascadeOnDelete();

            // Actual fields you want to translate
            $table->string('name',100)->unique();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_types');
        Schema::dropIfExists('case_type_translations');
    }
};
