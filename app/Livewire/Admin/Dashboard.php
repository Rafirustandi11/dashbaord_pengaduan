<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Pengaduan;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $stats = [];
    public $chartLine = [];
    public $chartBar = [];
    public $chartDonut = [];
    public $chartBidang = [];
    public $latestPerBidang = [];

    public function mount()
    {
        $this->loadStats();
        $this->loadLineChart();
        $this->loadBarChart();
        $this->loadDonutChart();
        $this->loadBidangChart();
        $this->loadLatestBidang();
    }

    // ==========================
    // STATISTIK
    // ==========================
    public function loadStats()
    {
        $this->stats = [
            'total'     => Pengaduan::count(),
            'menunggu'  => Pengaduan::where('status', 'Menunggu')->count(),
            'proses'    => Pengaduan::where('status', 'Proses')->count(),
            'selesai'   => Pengaduan::where('status', 'Selesai')->count(),
        ];
    }

    // ==========================
    // LINE CHART (6 BULAN)
    // ==========================
    public function loadLineChart()
    {
        $months = collect(range(5, 0))->map(fn ($i) =>
            Carbon::now()->subMonths($i)->format('Y-m')
        );

        $this->chartLine = [
            'labels' => $months->map(fn($m) => Carbon::parse($m.'-01')->format('M Y')),
            'values' => $months->map(fn($m) =>
                Pengaduan::whereYear('created_at', substr($m, 0, 4))
                    ->whereMonth('created_at', substr($m, 5, 2))
                    ->count()
            ),
        ];
    }

    // ==========================
    // BAR CHART (TOTAL PER STATUS)
    // ==========================
    public function loadBarChart()
    {
        $this->chartBar = [
            'labels' => ["Menunggu", "Proses", "Selesai"],
            'values' => [
                Pengaduan::where('status', 'Menunggu')->count(),
                Pengaduan::where('status', 'Proses')->count(),
                Pengaduan::where('status', 'Selesai')->count(),
            ],
        ];
    }

    // ==========================
    // DONUT CHART (PERSENTASE STATUS)
    // ==========================
    public function loadDonutChart()
    {
        $total = Pengaduan::count() ?: 1;

        $this->chartDonut = [
            'labels' => ["Menunggu", "Proses", "Selesai"],
            'values' => [
                round(Pengaduan::where('status','Menunggu')->count() / $total * 100),
                round(Pengaduan::where('status','Proses')->count() / $total * 100),
                round(Pengaduan::where('status','Selesai')->count() / $total * 100),
            ]
        ];
    }

    // ==========================
    // GRAFIK BERDASARKAN BIDANG
    // ==========================
    public function loadBidangChart()
    {
        $bidangs = ['egov', 'itik', 'statistik', 'persandian', 'pikp'];

        $this->chartBidang = [
            'labels' => ['E-Gov', 'ITIK', 'Statistik', 'Persandian', 'PIKP'],
            'values' => array_map(fn($b) =>
                Pengaduan::where('bidang_tujuan', $b)->count(),
                $bidangs
            ),
        ];
    }

    // ==========================
    // TABEL PENGADUAN TERBARU PER BIDANG
    // ==========================
    public function loadLatestBidang()
    {
        $bidangs = ['egov', 'itik', 'statistik', 'persandian', 'pikp'];

        foreach ($bidangs as $b) {
            $this->latestPerBidang[$b] = Pengaduan::where('bidang_tujuan', $b)
                ->latest()
                ->first();
        }
    }

    public function render()
    {
        return view('livewire.admin.dashboard')
            ->layout('layouts.admin');
    }
}
