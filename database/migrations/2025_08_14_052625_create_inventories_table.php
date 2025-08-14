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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            // Informasi asal usul panen
            $table->foreignId('panen_id')->constrained('panens');
            $table->string('batch_code');

            // Informasi kepemilikan
            $table->foreignId('distributor_id')->constrained('users');
            $table->foreignId('peternak_id')->constrained('users');

            // Detail produk
            $table->date('tanggal_panen');
            $table->integer('jumlah_ayam');
            $table->string('jenis_produk');
            $table->decimal('harga_per_ekor', 15, 2);
            $table->string('status')->default('Di Gudang'); // Status di inventaris
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
