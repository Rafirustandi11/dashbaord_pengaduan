<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Pengaduan;

class HistoriPengaduan extends Component
{
    public $statsPerBidang = [];
    public $statusDistribution = [];
    public $pengaduans = [];

    // Statistik utama
    public $totalPengaduan, $totalSelesai, $totalDiproses, $totalBaru;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        // 📌 Ambil semua pengaduan tanpa filter bulan
        $this->pengaduans = Pengaduan::orderBy('created_at', 'desc')->get();

        $bidangs = ['E-Gov', 'ITIK', 'Statistik', 'Persandian', 'PIKP'];

        // Rekap total per bidang
        $this->statsPerBidang = collect($bidangs)->map(function ($b) {
            return [
                'bidang' => $b,
                'total' => Pengaduan::where('bidang_tujuan', $b)->count(),
                'selesai' => Pengaduan::where('bidang_tujuan', $b)
                    ->where('status', 'Selesai')
                    ->count(),
            ];
        });

        // Distribusi status
        $this->statusDistribution = [
            'Menunggu' => $this->pengaduans->where('status', 'Menunggu')->count(),
            'Diteruskan ke Bidang' => $this->pengaduans->where('status', 'Diteruskan ke Bidang')->count(),
            'Proses' => $this->pengaduans->where('status', 'Proses')->count(),
            'Selesai' => $this->pengaduans->where('status', 'Selesai')->count(),
        ];

        // Statistik utama
        $this->totalPengaduan = $this->pengaduans->count();
        $this->totalSelesai = $this->pengaduans->where('status', 'Selesai')->count();
        $this->totalDiproses = $this->pengaduans->whereIn('status', ['Proses', 'Diteruskan ke Bidang'])->count();
        $this->totalBaru = $this->pengaduans->where('status', 'Menunggu')->count();
    }

    public function render()
    {
        return view('livewire.admin.histori-pengaduan', [
            'totalPengaduan' => $this->totalPengaduan,
            'totalSelesai'   => $this->totalSelesai,
            'totalDiproses'  => $this->totalDiproses,
            'totalBaru'      => $this->totalBaru,
            'pengaduans'     => $this->pengaduans,
        ])->layout('layouts.admin');
    }
}
