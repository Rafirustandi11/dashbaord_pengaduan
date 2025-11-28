<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        // === Pastikan role sudah ada ===
        $roles = ['admin', 'bidang', 'user'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // === ADMIN ===
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'bidang' => null,
            ]
        );
        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }

        // === 5 BIDANG (masing-masing 2 akun) ===
        $bidangs = ['egov', 'itik', 'statistik', 'persandian', 'pikp'];

        foreach ($bidangs as $bidang) {
            for ($i = 1; $i <= 2; $i++) {
                $user = User::updateOrCreate(
                    ['email' => "{$bidang}{$i}@bidang.com"],
                    [
                        'name' => ucfirst($bidang) . " User {$i}",
                        'password' => Hash::make('bidang123'),
                        'role' => 'bidang',
                        'bidang' => $bidang, // lowercase agar konsisten dengan field 'bidang_tujuan'
                    ]
                );

                if (!$user->hasRole('bidang')) {
                    $user->assignRole('bidang');
                }
            }
        }

        // === USER / WARGA UMUM ===
        $warga = User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Warga Umum',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'bidang' => null,
            ]
        );
        if (!$warga->hasRole('user')) {
            $warga->assignRole('user');
        }
    }
}
