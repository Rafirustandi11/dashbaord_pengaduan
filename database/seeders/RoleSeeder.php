<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // === 1️⃣ Buat role utama ===
        $roles = ['admin', 'bidang', 'warga'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // === 2️⃣ Buat akun Super Admin ===
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'bidang' => null,
            ]
        );
        $admin->assignRole('admin');

        // === 3️⃣ Buat 5 akun Bidang ===
        $bidangList = ['egov', 'itik', 'statistik', 'persandian', 'pikp'];

        foreach ($bidangList as $bidang) {
            // buat dua akun untuk setiap bidang
            for ($i = 1; $i <= 2; $i++) {
                $email = "{$bidang}{$i}@example.com";
                $name = ucfirst($bidang) . " User {$i}";

                $user = User::firstOrCreate(
                    ['email' => $email],
                    [
                        'name' => $name,
                        'password' => Hash::make('bidang123'),
                        'role' => 'bidang',
                        'bidang' => $bidang,
                    ]
                );

                $user->assignRole('bidang');
            }
        }

        // === 4️⃣ Info di console ===
        $this->command->info('✅ Roles dan akun admin + bidang berhasil dibuat.');
        $this->command->warn('🔑 Login Admin: admin@example.com / admin123');
        $this->command->warn('🔑 Login Bidang: egov1@example.com / bidang123 (dan seterusnya)');
    }
}
