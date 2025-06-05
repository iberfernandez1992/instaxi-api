<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vehicle_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedInteger('service_id')->nullable();
            $table->unsignedInteger('service_category_id')->nullable();
            $table->string('vehicle_image')->nullable(); // Asumo que es una imagen (path o UUID)
            $table->string('vehicle_map_icon')->nullable(); // Asumo que es una imagen (path o UUID)

            $table->string('slug', 191)->nullable()->index();
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_types');
    }
};
