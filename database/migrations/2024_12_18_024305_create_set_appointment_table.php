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
        Schema::create('set_appointment', function (Blueprint $table) {
            $table->id();
            $table->string("fullname");
            $table->string("datetime");
            $table->string("email");
            $table->string("number");
            $table->string("reason");
            $table->string("property");
            $table->text("message");
            $table->string("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('set_appointment');
    }
};
