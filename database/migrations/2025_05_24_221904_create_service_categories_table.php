<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateServiceCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('type')->nullable();
            $table->unsignedBigInteger('service_id')->nullable(); // puedes usar foreignId si relacionas con tabla services
            $table->longText('description')->nullable();
            $table->string('service_category_image_id')->nullable(); // Asumo que es una imagen (path o UUID)
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Índices
            $table->index('created_by_id');
            $table->index('service_category_image_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_categories');
    }
}