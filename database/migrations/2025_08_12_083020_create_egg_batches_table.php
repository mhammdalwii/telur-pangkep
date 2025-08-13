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
        Schema::create('egg_batches', function (Blueprint $table) {
            $table->id();
            $table->string('batch_code')->unique(); // Kode Unik
            $table->foreignId('farm_id')->constrained()->cascadeOnDelete();
            $table->date('production_date');
            $table->integer('quantity');
            $table->string('quality'); // misal: 'Grade A', 'Grade B'
            $table->string('coop_origin')->nullable(); // Asal kandang
            $table->string('status')->default('Di Peternakan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egg_batches');
    }
};
