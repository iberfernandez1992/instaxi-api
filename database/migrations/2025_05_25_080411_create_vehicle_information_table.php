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
    Schema::create('vehicle_information', function (Blueprint $table) {
        $table->id();
        $table->longText('name')->nullable();
        $table->longText('description')->nullable();
        $table->double('amb_per_dist_fees')->nullable();
        $table->string('plate_number')->nullable();
        $table->string('color')->nullable();
        $table->string('model')->nullable();
        $table->integer('seat')->nullable();
        $table->unsignedBigInteger('vehicle_type_id')->nullable();
        $table->unsignedBigInteger('driver_id')->nullable();
        $table->timestamps();
        $table->softDeletes();

        $table->foreign('vehicle_type_id')->references('id')->on('vehicle_types')->onDelete('set null');
        $table->foreign('driver_id')->references('id')->on('users')->onDelete('set null');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_information');
    }
};
