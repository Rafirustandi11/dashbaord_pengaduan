<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            // Cek dulu sebelum tambah agar tidak error jika sudah ada
            if (!Schema::hasColumn('pengaduans', 'no_hp')) {
                $table->string('no_hp', 20)->nullable()->after('email');
            }

            if (!Schema::hasColumn('pengaduans', 'kode_pengaduan')) {
                $table->string('kode_pengaduan', 25)->nullable()->unique()->after('id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            if (Schema::hasColumn('pengaduans', 'no_hp')) {
                $table->dropColumn('no_hp');
            }

            if (Schema::hasColumn('pengaduans', 'kode_pengaduan')) {
                $table->dropColumn('kode_pengaduan');
            }
        });
    }
};