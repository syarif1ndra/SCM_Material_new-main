<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('order_material', function (Blueprint $table) {
        $table->id();
        $table->integer('jumlah_order');
        $table->date('tanggal_order');
        $table->decimal('harga_total', 10, 2);
        $table->text('keterangan');
        $table->foreignId('material_pemasok_id')->constrained('material_pemasok')->cascadeOnDelete();

        $table->timestamps();
    });

}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_material');
    }
};
