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
        Schema::create('layanan_subs', function (Blueprint $table) {
            $table->id();
            $table->string('id_layanan_sub')->unique();
            $table->string('id_layanan');
            $table->date('tanggal');
            $table->text('deskripsi')->nullable();
            $table->string('foto', 100)->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_subs');
    }
};
