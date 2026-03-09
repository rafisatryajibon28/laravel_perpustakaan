<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->unique();
            $table->string('nama_lengkap');
            $table->string('kelas');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat');
            $table->string('no_telepon');
            $table->string('email')->unique();
            $table->date('tanggal_daftar');
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};