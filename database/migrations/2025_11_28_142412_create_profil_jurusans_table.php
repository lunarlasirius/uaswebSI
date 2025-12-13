<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_jurusans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jurusan', 150);
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->longText('sejarah')->nullable();
            $table->longText('sambutan_ketua')->nullable();
            $table->string('nama_ketua', 100)->nullable();
            $table->string('foto_ketua', 255)->nullable();
            $table->string('logo_jurusan', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_jurusans');
    }
};