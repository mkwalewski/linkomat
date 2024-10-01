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
        Schema::create('domain_pattern_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('domain_patterns_id');
            $table->string('field');
            $table->string('filter_type');
            $table->string('filter_pattern');
            $table->string('return_type');
            $table->string('return_path')->nullable();
            $table->foreign('domain_patterns_id')->references('id')->on('domain_patterns');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domain_pattern_fields');
    }
};
