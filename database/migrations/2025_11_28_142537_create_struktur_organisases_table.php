<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('struktur_organisasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('jabatan', 100);
            $table->integer('urutan')->default(0);

            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')
                  ->references('id')
                  ->on('struktur_organisasis')
                  ->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('struktur_organisasis');
    }
};