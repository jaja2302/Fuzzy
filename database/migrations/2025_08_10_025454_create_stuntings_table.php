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
        Schema::create('stuntings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->constrained('wilayahs')->onDelete('cascade');
            $table->integer('tahun');
            $table->integer('bulan')->nullable();
            $table->integer('jumlah_stunting');
            $table->timestamps();
            
            $table->unique(['wilayah_id', 'tahun', 'bulan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stuntings');
    }
};
