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
        Schema::create('ride_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rider_id')->index();
            $table->unsignedBigInteger('service_id')->nullable()->index();
            $table->unsignedBigInteger('vehicle_type_id')->nullable()->index();
            $table->unsignedBigInteger('service_category_id')->nullable()->index();

            $table->longText('locations')->nullable();
            $table->longText('location_coordinates')->nullable();

            $table->string('duration')->nullable();
            $table->string('distance')->nullable();
            $table->string('distance_unit')->nullable();

            $table->double('ride_fare')->nullable();
            $table->longText('description')->nullable();

            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();

            $table->enum('status', ['pending', 'accepted', 'completed', 'cancelled'])->default('pending');

            $table->unsignedBigInteger('created_by_id')->nullable()->index();

            $table->timestamps();
            $table->softDeletes(); // Agrega deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ride_requests');
    }
};
