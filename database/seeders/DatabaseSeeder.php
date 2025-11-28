<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🚀 Memulai proses seeding database...');

        // Jalankan seeder
        $this->call([
            RoleSeeder::class,
            UserRoleSeeder::class,
        ]);

        $this->command->info('✅ Semua role dan akun default berhasil dibuat.');
        $this->command->warn('🔑 Admin login: admin@example.com / admin123');
        $this->command->warn('🔑 Bidang login: egov1@bidang.com / bidang123');
        $this->command->warn('🔑 User umum: user@example.com / user123');
    }
}
