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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('domains_id');
            $table->string('url')->nullable();
            $table->string('video_id')->nullable();
            $table->string('channel_id')->nullable();
            $table->string('channel_url')->nullable();
            $table->string('title')->nullable();
            $table->string('author')->nullable();
            $table->timestamp('date')->nullable();
            $table->string('category')->nullable();
            $table->text('keywords')->nullable();
            $table->text('short_description')->nullable();
            $table->string('view_count')->nullable();
            $table->string('length')->nullable();
            $table->string('thumb')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('watch_at')->nullable();
            $table->foreign('domains_id')->references('id')->on('domains');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
