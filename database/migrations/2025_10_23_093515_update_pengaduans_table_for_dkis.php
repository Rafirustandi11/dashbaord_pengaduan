<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            if (!Schema::hasColumn('pengaduans', 'nama_warga')) {
                $table->string('nama_warga');
            }

            if (!Schema::hasColumn('pengaduans', 'email')) {
                $table->string('email')->nullable();
            }

            if (!Schema::hasColumn('pengaduans', 'kategori')) {
                $table->string('kategori')->nullable();
            }

            if (!Schema::hasColumn('pengaduans', 'bidang_tujuan')) {
                $table->string('bidang_tujuan')->nullable();
            }

            if (!Schema::hasColumn('pengaduans', 'isi_laporan')) {
                $table->text('isi_laporan');
            }

            if (!Schema::hasColumn('pengaduans', 'lampiran')) {
                $table->string('lampiran')->nullable();
            }

            if (!Schema::hasColumn('pengaduans', 'status')) {
                $table->enum('status', ['baru', 'proses', 'selesai', 'ditolak'])->default('baru');
            }

            if (!Schema::hasColumn('pengaduans', 'tanggapan_admin')) {
                $table->text('tanggapan_admin')->nullable();
            }

            if (!Schema::hasColumn('pengaduans', 'tanggapan_bidang')) {
                $table->text('tanggapan_bidang')->nullable();
            }

            if (!Schema::hasColumn('pengaduans', 'tanggal_disposisi')) {
                $table->dateTime('tanggal_disposisi')->nullable();
            }

            if (!Schema::hasColumn('pengaduans', 'tanggal_selesai')) {
                $table->dateTime('tanggal_selesai')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            // Tidak perlu rollback kolom ini jika sudah dipakai
        });
    }
};
