<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade'); 

            $table->string('nama', 100);
            $table->string('nidn', 30)->nullable();
            $table->string('bidang_keahlian', 150)->nullable();
            $table->string('foto', 255)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('no_hp', 20)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};