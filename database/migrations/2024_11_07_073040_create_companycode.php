<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
    {
        Schema::create('companycode', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->string('status')->unique();
            $table->string('code')->unique(); // Column for the company code
             $table->boolean('is_active')->default(true);
            $table->timestamps(); // Optional: created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companycode');
    }
};
