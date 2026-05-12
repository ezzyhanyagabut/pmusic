<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel albums
     */
    public function up(): void
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();                          // id
	    $table->foreignId('artist_id')->constrained()->onDelete('cascade');
            $table->string('title');          // nama album
            $table->string('cover');               // path cover album
            $table->timestamps();
        });
    }

    /**
     * Menghapus tabel albums
     */
    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
