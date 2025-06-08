<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ride_request_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ride_request_id')->constrained()->onDelete('cascade');
            $table->foreignId('driver_id')->constrained('users')->onDelete('cascade');

            $table->enum('status', ['pending', 'accepted', 'rejected', 'expired','offered'])->default('pending');
            $table->timestamp('notified_at');
            $table->timestamp('responded_at')->nullable();
            $table->integer('response_time_sec')->nullable();
            $table->string('device_type')->nullable();
            $table->text('fcm_token_snapshot')->nullable();
            $table->decimal('price_offer', 8, 2)->nullable()->after('status');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ride_request_notifications');
    }
};
