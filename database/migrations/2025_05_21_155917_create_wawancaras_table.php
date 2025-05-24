<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('wawancaras', function (Blueprint $table) {
            $table->id();
            $table->string('tahun');
            $table->string('jurusan');
            $table->string('kondisi');
            $table->integer('jumlah');
            $table->integer('hari_ini');
            $table->integer('kemarin');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wawancaras');
    }
};

