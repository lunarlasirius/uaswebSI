<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestases', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 150);
            $table->text('deskripsi')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('tingkat', 50)->nullable(); 
            $table->enum('kategori', ['mahasiswa', 'dosen', 'jurusan'])->nullable();
            $table->string('foto', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestasis');
    }
};