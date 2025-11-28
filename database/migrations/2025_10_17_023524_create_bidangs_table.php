<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bidangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bidang')->unique();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        // Seed data bidang otomatis
        DB::table('bidangs')->insert([
            ['nama_bidang' => 'Egov'],
            ['nama_bidang' => 'ITIK'],
            ['nama_bidang' => 'Statistik'],
            ['nama_bidang' => 'Persandian'],
            ['nama_bidang' => 'PIKP'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('bidangs');
    }
};
