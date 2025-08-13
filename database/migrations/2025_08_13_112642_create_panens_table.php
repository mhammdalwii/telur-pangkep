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
        Schema::create('panens', function (Blueprint $table) {
            $table->id();
            $table->string('batch_code')->unique();
            $table->foreignId('user_id')->constrained('users');
            $table->date('tanggal_panen');
            $table->string('asal_kandang');
            $table->integer('jumlah_ayam');
            $table->string('jenis_produk');
            $table->decimal('harga_per_ekor', 15, 2);
            $table->string('status')->default('Siap Kirim'); // Status awal
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panens');
    }
};
