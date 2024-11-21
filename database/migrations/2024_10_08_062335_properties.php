<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('key');
            $table->string('status');
            $table->string('location');
            $table->string('specific_location'); // Ensure this field is present
            $table->string('price_range')->nullable(); // Optional
            $table->string('units')->nullable(); // Optional
            $table->string('land_area')->nullable(); // Optional
            $table->string('development_type')->nullable(); // Optional
            $table->string('architectural_theme')->nullable(); // Optional
            $table->string('path')->nullable(); // Optional image path
            $table->string('view')->nullable(); // Optional view image path
            $table->text('features')->nullable(); // Change this line; // If features are stored as a string, but consider a separate table for features
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
};
