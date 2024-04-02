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
        Schema::create('facility_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('facility_id');
            $table->string('facility_type');
            $table->string('location')->nullable();
            $table->string('address');
            $table->tinyInteger('city')->default(1);
            $table->string('postal_code',8);
            $table->string('phone',15);
            $table->time('open_hours');
            $table->time('close_hours');
            $table->string('owner_name',100);
            $table->string('owner_phone',15);
            $table->string('owner_email',100);
            $table->timestamps();
        });

    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facility_profiles');
    }
};
