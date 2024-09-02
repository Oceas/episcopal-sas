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
        Schema::create('votd', function (Blueprint $table) {
            $table->id();
            $table->string('month');
            $table->string('day');
            $table->string('year');
            $table->string('reference');
            $table->text('text')->nullable();
            $table->text('content')->nullable();
            $table->string('version_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('v_o_t_d_s');
    }

};
