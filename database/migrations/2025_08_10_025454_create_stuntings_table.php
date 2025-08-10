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
            $table->id('id_stunting');
            $table->unsignedBigInteger('id_wilayah');
            $table->integer('tahun');
            $table->integer('jumlah_stunting');
            $table->timestamps();
            
            $table->foreign('id_wilayah')->references('ID_Wilayah')->on('wilayahs')->onDelete('cascade');
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
