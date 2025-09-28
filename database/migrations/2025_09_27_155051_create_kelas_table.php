<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('tingkat'); // X, XI, XII
            $table->string('kode_kelas'); // TKJ 1, TKJ 2
            $table->foreignId('jurusan_id')->constrained('jurusan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('kelas');
    }
};
