<?php

namespace App\Livewire\Bidang;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProfilBidang extends Component
{
    public $bidang;
    public $kepala;
    public $email;
    public $phone;
    public $alamat;
    public $deskripsi;

    public function mount()
    {
        $this->bidang = Auth::user()->bidang ?? 'egov';

        // Data statis contoh sesuai React.tsx
        $info = [
            'egov' => [
                'kepala' => 'Dr. Ahmad Susanto',
                'email' => 'egov@sistem.com',
                'phone' => '+62 812-1111-1111',
                'alamat' => 'Gedung A Lantai 3',
                'deskripsi' => 'Bidang E-Government bertanggung jawab atas pengembangan dan pengelolaan sistem pemerintahan berbasis elektronik.',
            ],
            'itik' => [
                'kepala' => 'Ir. Budi Santoso, M.Kom',
                'email' => 'itik@sistem.com',
                'phone' => '+62 812-2222-2222',
                'alamat' => 'Gedung B Lantai 2',
                'deskripsi' => 'Bidang ITIK mengelola infrastruktur teknologi informasi dan komunikasi.',
            ],
            'statistik' => [
                'kepala' => 'Siti Rahayu, S.ST, M.Si',
                'email' => 'statistik@sistem.com',
                'phone' => '+62 812-3333-3333',
                'alamat' => 'Gedung A Lantai 2',
                'deskripsi' => 'Bidang Statistik mengelola data dan analisis statistik daerah.',
            ],
            'persia' => [
                'kepala' => 'Drs. Hendra Wijaya',
                'email' => 'persia@sistem.com',
                'phone' => '+62 812-4444-4444',
                'alamat' => 'Gedung C Lantai 1',
                'deskripsi' => 'Bidang Persandian bertanggung jawab atas keamanan informasi dan data.',
            ],
            'pipkp' => [
                'kepala' => 'Dewi Kartika, S.Kom, M.M',
                'email' => 'pipkp@sistem.com',
                'phone' => '+62 812-5555-5555',
                'alamat' => 'Gedung B Lantai 3',
                'deskripsi' => 'PIPKP mengelola perencanaan, pengembangan, dan kerjasama.',
            ],
        ];

        $data = $info[$this->bidang] ?? $info['egov'];

        $this->kepala = $data['kepala'];
        $this->email = $data['email'];
        $this->phone = $data['phone'];
        $this->alamat = $data['alamat'];
        $this->deskripsi = $data['deskripsi'];
    }

    public function simpan()
    {
        session()->flash('message', 'Perubahan profil bidang berhasil disimpan!');
    }

    public function updatePassword()
    {
        session()->flash('message', 'Password berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.bidang.profil-bidang')->layout('layouts.bidang');
    }
}
