<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ruang_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_admin_id')->constrained('users')->onDelete('cascade');
            $table->string('penanggung_jawab');
            $table->string('nama_kegiatan');
            $table->string('fungsi'); // divisi
            $table->integer('jumlah_peserta'); // divisi
            $table->date('tanggal');
            $table->string('fasilitas');
            $table->string('catatan_pelaksanaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
