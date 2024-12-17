<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('properties')->onDelete('cascade'); // Foreign key reference to properties
            $table->string('name')->nullable();// Name of the building
            $table->string('development_type'); // Type of development (e.g., High Rise Condominiums)
            $table->integer('residential_levels')->nullable(); // Allow null for residential levels
            $table->integer('basement_parking_levels')->nullable(); // Optional: Number of basement parking levels
            $table->integer('podium_parking_levels')->nullable(); // Optional: Number of podium parking levels
            $table->integer('lower_ground_floor_parking_levels')->nullable(); 
            $table->integer('commercial_units')->nullable(); // Optional: Number of commercial units available
            $table->string('path')->nullable();// Path of the building
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('buildings');
    }
};
