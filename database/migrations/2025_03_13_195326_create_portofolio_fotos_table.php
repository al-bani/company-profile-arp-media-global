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
        Schema::create('portofolio_fotos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('id_portofolio_foto')->unique();
            $table->string('id_portofolio');
            $table->string('judul_foto', 255);
            $table->string('foto', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_fotos');
    }
};
