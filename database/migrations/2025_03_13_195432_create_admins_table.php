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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('id_admin')->unique();
            $table->string('id_perusahaan');
            $table->string('nama_admin');
            $table->enum('role', ['superAdmin', 'admin'])->default('admin');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_telepon');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
