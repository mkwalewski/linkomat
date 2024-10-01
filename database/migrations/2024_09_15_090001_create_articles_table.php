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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('domains_id');
            $table->string('url')->nullable();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->dateTime('date')->nullable();
            $table->string('author')->nullable();
            $table->string('category')->nullable();
            $table->string('tags')->nullable();
            $table->mediumText('content')->nullable();
            $table->smallInteger('words_count')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->boolean('is_premium')->default(false);
            $table->foreign('domains_id')->references('id')->on('domains');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};