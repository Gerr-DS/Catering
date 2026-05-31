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
        Schema::create('transaksi_keuangans', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->unsignedBigInteger('id_admin');
            $table->unsignedBigInteger('id_laporan')->nullable();
            $table->integer('jenis_transaksi'); // 1 = Pemasukan, 2 = Pengeluaran
            $table->date('tanggal');
            $table->decimal('nominal', 15, 2);
            $table->string('deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('id_admin')->references('id_admin')->on('admins')->onDelete('cascade');
            $table->foreign('id_laporan')->references('id_laporan')->on('laporans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_keuangans');
    }
};
