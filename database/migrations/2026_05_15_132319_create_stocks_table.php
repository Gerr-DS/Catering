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
        Schema::create('stok_bahans', function (Blueprint $table) {
            $table->id('id_stok');
            $table->unsignedBigInteger('id_admin');
            $table->string('nama_bahan');
            $table->integer('jumlah_stok');
            $table->string('satuan');
            $table->timestamps();

            $table->foreign('id_admin')->references('id_admin')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_bahans');
    }
};
