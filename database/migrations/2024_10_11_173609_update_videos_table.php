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
        Schema::table('videos', function (Blueprint $table) {
            $table->unsignedBigInteger('playlists_id')->nullable();
            $table->timestamp('archived_at')->nullable();
            $table->foreign('playlists_id')->references('id')->on('playlists');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropForeign(['playlists_id']);
            $table->dropColumn('playlists_id');
            $table->dropColumn('archived_at');
        });
    }
};
