<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('form_fields', function (Blueprint $table) {
            $table->id();
            $table->string('label'); // Label yang ditampilkan di form
            $table->string('name'); // nama variabel (contoh: nama_warga)
            $table->string('type')->default('text'); // text, email, textarea, select, file
            $table->string('placeholder')->nullable();
            $table->boolean('required')->default(false);
            $table->boolean('active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_fields');
    }
};
