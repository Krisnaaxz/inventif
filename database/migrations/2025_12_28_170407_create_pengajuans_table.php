<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->enum('jenis', ['peminjaman', 'penyewaan'])->default('penyewaan');
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak', 'selesai', 'dibatalkan'])->default('menunggu');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->text('alasan');
            $table->integer('durasi_sewa')->nullable();
            $table->integer('total_biaya')->nullable();
            $table->string('surat_pengajuan');
            $table->timestamp('tanggal_pengajuan')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('returned_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
