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
        Schema::create('m_karyawan', function (Blueprint $table) {
            $table->bigIncrements('karyawan_id');
            $table->string('nik')->unique();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat');
            $table->string('email');
            $table->string('no_telepon');
            
            // Foreign keys
            $table->unsignedBigInteger('departemen_id')->index();
            $table->unsignedBigInteger('jabatan_id')->index();
    
            $table->date('tanggal_masuk');
            $table->timestamps();
    
            // Relasi ke tabel lain
            $table->foreign('departemen_id')->references('id')->on('m_departemen')->onDelete('cascade');
            $table->foreign('jabatan_id')->references('id')->on('m_jabatan')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_karyawan');
    }
};
