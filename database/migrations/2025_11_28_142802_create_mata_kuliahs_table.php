<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mata_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mk', 20)->unique();
            $table->string('nama_mk', 150);
            $table->unsignedTinyInteger('sks')->default(2);
            $table->unsignedTinyInteger('semester')->nullable(); 
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mata_kuliahs');
    }
};