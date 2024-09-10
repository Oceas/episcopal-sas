<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('wp_post_id')->nullable(); // Changed to an unsigned big integer as per your comment
            $table->string('title');
            $table->string('link')->nullable();
            $table->string('excerpt')->nullable();
            $table->text('content')->nullable();
            $table->timestamp('publish_date')->default(DB::raw('CURRENT_TIMESTAMP')); // Default to current timestamp for publish date with time
            $table->string('author_name')->default('anonymous'); // Default author to 'anonymous'
            $table->string('featured_image')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
