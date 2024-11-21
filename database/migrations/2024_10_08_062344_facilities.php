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
            Schema::create('facilities', function (Blueprint $table) {
                $table->id(); // Auto-incrementing ID
                $table->foreignId('property_id')->constrained()->onDelete('cascade'); // Foreign key referencing properties
                $table->string('name'); // Ensure this line is present for the name of the facility
                $table->timestamps(); // Created and updated timestamps
            });
        }
        public function down()
        {
            Schema::dropIfExists('facilities');
        }
    };
