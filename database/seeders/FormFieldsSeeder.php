<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FormField;

class FormFieldsSeeder extends Seeder
{
    public function run(): void
    {
        $fields = [
            [
                'label' => 'Nama Lengkap',
                'name' => 'nama_lengkap',
                'type' => 'text',
                'placeholder' => 'Masukkan nama lengkap Anda',
                'required' => true,
                'active' => true,
                'order' => 1,
            ],
            [
                'label' => 'Email (Opsional)',
                'name' => 'email',
                'type' => 'email',
                'placeholder' => 'Masukkan alamat email Anda (jika ada)',
                'required' => false,
                'active' => true,
                'order' => 2,
            ],
            [
                'label' => 'Nomor Telepon / WA',
                'name' => 'no_hp',
                'type' => 'text',
                'placeholder' => 'Contoh: 08123456789',
                'required' => true,
                'active' => true,
                'order' => 3,
            ],
            [
                'label' => 'Kategori Masalah',
                'name' => 'kategori',
                'type' => 'select',
                'placeholder' => '',
                'required' => true,
                'active' => true,
                'order' => 4,
                'options' => json_encode([
                    'E-Government',
                    'Data & Statistik',
                    'Infrastruktur Digital',
                    'Informasi Publik',
                    'Layanan Aplikasi',
                ]),
            ],
            [
                'label' => 'Judul Pengaduan',
                'name' => 'judul_pengaduan',
                'type' => 'text',
                'placeholder' => 'Tuliskan judul singkat pengaduan Anda',
                'required' => true,
                'active' => true,
                'order' => 5,
            ],
            [
                'label' => 'Isi Laporan / Keluhan',
                'name' => 'isi_laporan',
                'type' => 'textarea',
                'placeholder' => 'Jelaskan secara rinci pengaduan Anda',
                'required' => true,
                'active' => true,
                'order' => 6,
            ],
            [
                'label' => 'Lampiran Bukti (Opsional)',
                'name' => 'lampiran',
                'type' => 'file',
                'placeholder' => '',
                'required' => false,
                'active' => true,
                'order' => 7,
            ],
        ];

        foreach ($fields as $field) {
            FormField::updateOrCreate(['name' => $field['name']], $field);
        }
    }
}
