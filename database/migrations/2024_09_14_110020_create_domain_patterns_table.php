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
        Schema::create('domain_patterns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('domains_id');
            $table->string('pattern', 250);
            $table->string('parser', 50);
            $table->boolean('is_premium')->default(false);
            $table->foreign('domains_id')->references('id')->on('domains');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domain_patterns');
    }
};
