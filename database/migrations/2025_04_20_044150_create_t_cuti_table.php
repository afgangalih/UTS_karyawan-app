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
        Schema::create('t_cuti', function (Blueprint $table) {
            $table->bigIncrements('cuti_id');
            $table->unsignedBigInteger('karyawan_id')->index();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('jenis_cuti'); // contoh: Tahunan, Sakit, Izin, dll
            $table->text('alasan');
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->text('catatan_admin')->nullable(); // untuk komentar tambahan jika ditolak
            $table->timestamps();

            $table->foreign('karyawan_id')->references('karyawan_id')->on('m_karyawan')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuti');
    }
};
