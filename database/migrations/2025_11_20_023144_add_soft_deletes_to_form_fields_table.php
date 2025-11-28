<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan kolom deleted_at ke tabel form_fields
     */
    public function up(): void
    {
        Schema::table('form_fields', function (Blueprint $table) {
            $table->softDeletes(); // membuat kolom deleted_at
        });
    }

    /**
     * Menghapus kolom deleted_at (rollback)
     */
    public function down(): void
    {
        Schema::table('form_fields', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
};
