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
        Schema::create('material_proyek', function (Blueprint $table) {
            $table->id();
            $table->string('nama_material', 255);
            $table->integer('stok');
            $table->decimal('harga_total', 10, 2);
            $table->string('jenis_material', 100);
            $table->unsignedBigInteger('pengiriman_id'); // Tambahkan kolom ini untuk relasi
            $table->timestamps();

            $table->foreign('pengiriman_id')->references('id')->on('pengiriman')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_proyek');
    }
};
