<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade'); 

            $table->string('npm', 30)->unique();
            $table->string('nama', 100);
            $table->text('alamat')->nullable();
            $table->integer('angkatan')->nullable(); 

            $table->foreignId('dosen_pembimbing_id')
                  ->nullable()
                  ->constrained('dosens')
                  ->nullOnDelete(); 

            $table->string('no_hp', 20)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};