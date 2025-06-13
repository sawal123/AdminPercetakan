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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nama');
            $table->foreignId('bahan_id')->constrained('bahans')->onDelete('cascade');
            $table->string('ukuran')->nullable();
            $table->string('satuan')->default('pcs');
            $table->integer('stok')->default(0);
            $table->integer('harga_seller')->default(0);
            $table->integer('harga')->default(0);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
