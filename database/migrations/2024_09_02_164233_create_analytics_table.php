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
        Schema::create('analytics', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('platform')->nullable(); // Website or Mobile
            $table->string('vid')->nullable(); // VID can be a device ID or url
            $table->string('event_name')->nullable(); // 'play_video'
            $table->string('event_details')->nullable(); // 'uuid of video'
            $table->string('reference_url')->nullable(); // 'uuid of video'
            $table->string('app_version')->nullable();
            $table->json('payload')->nullable(); // raw data optional for other detail we may want to source later
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analytics');
    }
};
