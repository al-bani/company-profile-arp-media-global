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
        Schema::create('perusahaans', function (Blueprint $table) {
            $table->id();
            $table->string('id_perusahaan')->unique();
            $table->string('nama_perusahaan')->nullable();
            $table->string('logo_utama')->nullable();
            $table->string('logo_website')->nullable();
            $table->string('nib')->unique();
            $table->text('notaris');
            $table->string('npwp')->unique();
            $table->text('deskripsi');
            $table->text('alamat_perusahaan');
            $table->text('alamat_kantor');
            $table->text('maps');
            $table->string('email')->unique();
            $table->string('no_telpon');
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('twitter')->nullable();
            $table->string('moto')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->text('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaans');
    }
};
