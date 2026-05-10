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
    Schema::create('trash_bins', function (Blueprint $table) {
        $table->id();
        $table->string('lokasi'); // Contoh: Sagulung, Odessa
        $table->integer('kapasitas'); // 0 - 100%
        $table->string('status_truk'); // Standby / Menuju Lokasi
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trash_bins');
    }
};
