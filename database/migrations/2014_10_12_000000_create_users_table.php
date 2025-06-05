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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('country_code')->nullable();
            $table->string('phone')->unique();
            $table->string('password');
            $table->bigInteger('profile_image_id')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->integer('status')->default(1);
            $table->string('role')->nullable();
            $table->string('referral_code')->nullable()->index();
            $table->string('fcm_token')->nullable();
            $table->rememberToken();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
            $table->integer('is_online')->default(0);
            $table->integer('is_on_ride')->default(0);
            $table->longText('location')->nullable();
            $table->decimal('lat', 10, 8)->nullable();  
            $table->decimal('lng', 11, 8)->nullable(); 
            $table->unsignedBigInteger('service_id')->nullable()->index();
            $table->unsignedBigInteger('service_category_id ')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
