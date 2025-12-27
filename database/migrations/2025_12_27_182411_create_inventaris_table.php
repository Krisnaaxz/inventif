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
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_inventaris_id')->nullable()->constrained('kategori_inventaris')->nullOnDelete();
            $table->string('nama_inventaris');
            $table->string('gambar_inventaris')->nullable();
            $table->text('deskripsi_inventaris')->nullable();
            $table->integer('jumlah_inventaris')->default(1);
            $table->integer('harga_inventaris')->nullable();
            $table->integer('sewa_inventaris')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};