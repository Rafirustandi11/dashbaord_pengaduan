<?php

namespace App\Livewire\Bidang;

use Livewire\Component;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class HistoriPengaduan extends Component
{
    public $histori = [];

    public function mount()
    {
        $bidangUser = Auth::user()->bidang ?? null;

        // Ambil pengaduan sesuai bidang login
        $this->histori = Pengaduan::where('bidang_tujuan', $bidangUser)
            ->whereIn('status', ['Proses', 'Selesai'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.bidang.histori-pengaduan', [
            'histori' => $this->histori,
        ])->layout('layouts.bidang');
    }
}
