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
        Schema::create('menus', function (Blueprint $table) {
            $table->id('id_menu');
            $table->unsignedBigInteger('id_admin');
            $table->string('nama_menu');
            $table->decimal('harga_menu', 15, 2);
            $table->string('status_menu'); // "1" = Ready/Aktif, "0" = Nonaktif/Habis
            $table->text('deskripsi')->nullable();
            $table->integer('stok_menu')->default(0);
            $table->string('gambar')->nullable();
            $table->timestamps();

            $table->foreign('id_admin')->references('id_admin')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
