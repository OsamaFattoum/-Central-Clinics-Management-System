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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->boolean('gender')->default(1);
            $table->date('birth_date');
            $table->string('phone',15);
            $table->tinyInteger('city')->default(1);
            $table->string('address');
            $table->unsignedInteger('profile_id');
            $table->string('profile_type');
            $table->timestamps();
        });
        Schema::create('profile_translations', function (Blueprint $table) {
            // mandatory fields
            $table->id();
            $table->string('locale')->index();

            // Foreign key to the main model
            $table->unique(['profile_id', 'locale']);
            $table->foreignId('profile_id')->references('id')->on('profiles')->cascadeOnDelete();

            // Actual fields you want to translate
            $table->string('name',100)->unique();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('profile_translations');
    }
};
