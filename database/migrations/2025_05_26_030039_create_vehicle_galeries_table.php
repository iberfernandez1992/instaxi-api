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
        Schema::create('vehicle_galeries', function (Blueprint $table) {
            $table->id();
            $table->string('soat_photo', 255)->nullable();
            $table->string('ci_photo', 255)->nullable();
            $table->string('address_voucher_photo', 255)->nullable();
            $table->string('matricula_photo', 255)->nullable();
            $table->string('driver_license_photo', 255)->nullable();

            $table->unsignedBigInteger('driver_id')->nullable();
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('set null');

            $table->unsignedBigInteger('id_vehicle')->nullable();
            $table->foreign('id_vehicle')->references('id')->on('vehicle_information')->onDelete('set null');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_galeries');
    }
};
