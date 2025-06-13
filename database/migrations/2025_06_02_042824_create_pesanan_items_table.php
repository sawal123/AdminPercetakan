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
        Schema::create('pesanan_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained()->onDelete('cascade');
            $table->foreignId('barang_id')->constrained()->onDelete('cascade');
            $table->float('panjang')->nullable(); // misal: meter
            $table->float('lebar')->nullable();
            $table->integer('jumlah')->default(1); // untuk barang satuan
            $table->integer('harga_satuan'); // ambil dari harga barang
            $table->integer('subtotal'); // hasil kalkulasi: panjang * lebar * harga atau jumlah * harga
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan_items');
    }
};
