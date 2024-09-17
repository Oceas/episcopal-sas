<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('device_id')->unique();
            $table->string('app_version')->nullable();
            $table->string('brand')->nullable();
            $table->string('design_name')->nullable();
            $table->string('device_name')->nullable();
            $table->string('product_name')->nullable();
            $table->string('supported_cpu_architectures')->nullable();
            $table->unsignedBigInteger('total_memory')->nullable();
            $table->integer('device_year_class')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('model_id')->nullable();
            $table->string('model_name')->nullable();
            $table->string('os_build_id')->nullable();
            $table->string('os_long_name')->nullable();
            $table->string('os_name')->nullable();
            $table->string('os_version')->nullable();
            $table->string('ip_address')->nullable();
            $table->json('location')->nullable();
            $table->boolean('is_first_time_signup')->default(false);
            $table->timestamp('last_seen')->nullable();
            $table->string('push_token')->unique()->nullable();
            $table->boolean('push_token_valid')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps(); // Adds created_at and updated_at
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
