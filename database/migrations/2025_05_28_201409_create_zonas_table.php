<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('zonas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->geometry('place_points')->nullable();
            $table->longText('locations')->nullable();
            $table->decimal('amount', 15, 2)->default(0.00);
            $table->integer('status')->default(1);
            $table->enum('distance_type', ['mile', 'km'])->default('mile');

            $table->timestamps();
            $table->softDeletes();

            $table->index('name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('zonas');
    }
};
