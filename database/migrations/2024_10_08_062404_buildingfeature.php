<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('building_features', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('building_id'); // Foreign key
            $table->string('name'); // This is the column you need
            $table->timestamps();
    
            // Set up foreign key constraint
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('building_features');
    }
};
