<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_fasilitas', 150);
            $table->text('deskripsi')->nullable();
            $table->string('foto', 255)->nullable();
            $table->enum('kategori', ['laboratorium', 'ruang_jurusan', 'lainnya'])->default('lainnya');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};