<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pengaduan;
use App\Models\FormField; // model untuk tabel form_fields

class HistoriPengaduan extends Component
{
    use WithPagination;

    // ── Statistik ringkasan ────────────────────────────────────
    public int $totalPengaduan = 0;
    public int $totalSelesai   = 0;
    public int $totalDiproses  = 0;
    public int $totalBaru      = 0;

    // ── State filter (reaktif via wire:model.live) ─────────────
    public string $search         = '';
    public string $filterKategori = '';
    public string $filterBidang   = '';
    public string $filterStatus   = '';

    public function updatingSearch()         { $this->resetPage(); }
    public function updatingFilterKategori() { $this->resetPage(); }
    public function updatingFilterBidang()   { $this->resetPage(); }
    public function updatingFilterStatus()   { $this->resetPage(); }

    public function mount(): void
    {
        $this->hitungStatistik();
    }

    private function hitungStatistik(): void
    {
        $this->totalPengaduan = Pengaduan::count();
        $this->totalSelesai   = Pengaduan::where('status', 'Selesai')->count();
        $this->totalDiproses  = Pengaduan::whereIn('status', ['Proses', 'Diteruskan ke Bidang'])->count();
        $this->totalBaru      = Pengaduan::where('status', 'Menunggu')->count();
    }

    public function render()
    {
        // ── Query pengaduan dengan filter ────────────────────
        $query = Pengaduan::orderBy('created_at', 'desc');

        if ($this->search !== '') {
            $cari = $this->search;
            $query->where(function ($q) use ($cari) {
                $q->where('nama_warga', 'like', "%{$cari}%")
                  ->orWhere('no_hp',    'like', "%{$cari}%")
                  ->orWhere('email',    'like', "%{$cari}%");
            });
        }

        if ($this->filterKategori !== '') {
            $query->where('kategori', $this->filterKategori);
        }

        if ($this->filterBidang !== '') {
            $query->where('bidang_tujuan', $this->filterBidang);
        }

        if ($this->filterStatus !== '') {
            $query->where('status', $this->filterStatus);
        }

        $pengaduans = $query->paginate(15);

        // ── Ambil opsi kategori dari form_fields (dinamis) ───
        $opsiKategori = $this->getOpsiKategori();

        return view('livewire.admin.histori-pengaduan', [
            'pengaduans'     => $pengaduans,
            'opsiKategori'   => $opsiKategori,
            'totalPengaduan' => $this->totalPengaduan,
            'totalSelesai'   => $this->totalSelesai,
            'totalDiproses'  => $this->totalDiproses,
            'totalBaru'      => $this->totalBaru,
        ])->layout('layouts.admin');
    }

    private function getOpsiKategori(): array
    {
        $field = FormField::where('name', 'kategori')
            ->where('active', 1)
            ->whereNull('deleted_at')
            ->first();

        if (!$field || !$field->options) {
            return [];
        }

        $decoded = json_decode($field->options, true);
        return is_array($decoded) ? array_values(array_filter($decoded)) : [];
    }
}