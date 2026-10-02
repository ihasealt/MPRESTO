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
        Schema::create('prestasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nim');
            $table->string('mahasiswa');
            $table->string('prodi')->default('Sistem Informasi');
            $table->string('judul');
            $table->string('kategori'); // Teknologi & Desain, Akademik & Sains, Karya Ilmiah, dll
            $table->string('tingkat'); // Internasional, Nasional, Regional, Provinsi, Universitas
            $table->string('peringkat')->nullable(); // Juara 1, Juara 2, Juara 3, Finalis, dll
            $table->string('penyelenggara');
            $table->date('tanggal');
            $table->string('tahun', 4);
            $table->integer('poin')->default(0);
            $table->string('status')->default('Menunggu Verifikasi'); // Menunggu Verifikasi, Terverifikasi, Ditolak
            $table->text('catatan')->nullable();
            $table->string('berkas')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasis');
    }
};
