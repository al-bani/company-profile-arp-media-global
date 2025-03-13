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
            $table->timestamps();
            $table->string('nama', 100);
            $table->string('logo', 100);
            $table->string('moto', 255)->nullable();
            $table->string('media_sosial')->nullable();
            $table->text('alamat');
            $table->text('deskripsi')->nullable();
            $table->string('nib', 50)->nullable();
            $table->string('npwp', 50)->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->string('notaris', 100)->nullable();
            $table->string('email', 100)->unique();
            $table->string('no_telp', 20);
            $table->boolean('status')->default(1);
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