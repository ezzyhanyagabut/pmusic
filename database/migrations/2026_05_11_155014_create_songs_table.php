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
        Schema::create('songs', function (Blueprint $table) {
            $table->id();

            // Relasi ke artist dan album
            $table->foreignId('artist_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('album_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Informasi lagu
            $table->string('title');
	    $table->string('genre')->nullable();
            $table->string('youtube_id')->nullable();
            $table->string('file')->nullable();

            // Statistik
            $table->unsignedInteger('likes')->default(0);
            $table->boolean('is_trending')->default(false);

            // Timestamp
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
