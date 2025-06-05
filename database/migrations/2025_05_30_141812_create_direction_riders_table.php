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
         Schema::create('direction_riders', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->decimal('lat', 10, 7);
        $table->decimal('lng', 10, 7);
        $table->unsignedBigInteger('id_rider');
        $table->foreign('id_rider')->references('id')->on('users')->onDelete('cascade');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direction_riders');
    }
};
