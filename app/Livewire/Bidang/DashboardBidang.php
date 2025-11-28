<?php

namespace App\Livewire\Bidang;

use Livewire\Component;
use App\Models\Pengaduan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class DashboardBidang extends Component
{
    // stats & charts
    public $stats = [];
    public $chartLine = [];
    public $chartBar = [];
    public $chartDonut = [];
    public $chartJenis = [];
    public $chart7Hari = [];

    // controls / filters
    public $bidangFilter;          // default = user bidang
    public $startDate;
    public $endDate;
    public $colorScheme = 'default';

    // table
    public $latestPengaduan = [];

    // available color presets
    public $colorPresets = [
        'default' => ['primary' => '#4F46E5', 'accent' => '#10B981', 'warn' => '#F59E0B'],
        'sunset'  => ['primary' => '#EF4444', 'accent' => '#F97316', 'warn' => '#F59E0B'],
        'ocean'   => ['primary' => '#0EA5E9', 'accent' => '#06B6D4', 'warn' => '#7C3AED'],
    ];

    public function mount()
    {
        $this->bidangFilter = strtolower(Auth::user()->bidang ?? 'egov');
        // default: last 30 days
        $this->startDate = Carbon::today()->subDays(30)->toDateString();
        $this->endDate = Carbon::today()->toDateString();

        $this->loadAll();
    }

    public function updated($key, $value)
    {
        // when any filter changes, reload
        if (in_array($key, ['bidangFilter','startDate','endDate','colorScheme'])) {
            $this->loadAll();
        }
    }

    protected function bidangValue()
    {
        return strtolower($this->bidangFilter ?? Auth::user()->bidang ?? 'egov');
    }

    public function loadAll()
    {
        $this->loadStats();
        $this->loadLineChart();
        $this->loadBarChart();
        $this->loadDonutChart();
        $this->loadJenisChart();
        $this->load7Hari();
        $this->loadLatestTable();
    }

    // -----------------------
    // STATS
    // -----------------------
    protected function loadStats()
    {
        $b = $this->bidangValue();

        $base = Pengaduan::query()
            ->whereRaw('LOWER(bidang_tujuan) = ?', [$b]);

        if ($this->startDate) $base->whereDate('created_at', '>=', $this->startDate);
        if ($this->endDate) $base->whereDate('created_at', '<=', $this->endDate);

        $this->stats = [
            'total'     => (clone $base)->count(),
            'menunggu'  => (clone $base)->where('status', 'Menunggu')->count(),
            'proses'    => (clone $base)->where('status', 'Proses')->count(),
            'selesai'   => (clone $base)->where('status', 'Selesai')->count(),
        ];
    }

    // -----------------------
    // LINE CHART (6 BULAN)
    // -----------------------
    protected function loadLineChart()
    {
        $b = $this->bidangValue();
        $months = collect(range(5, 0))->map(fn($i) => Carbon::now()->subMonths($i)->format('Y-m'));
        $labels = $months->map(fn($m) => Carbon::parse($m.'-01')->format('M Y'));
        $values = $months->map(fn($m) => 
            Pengaduan::whereRaw('LOWER(bidang_tujuan) = ?', [$b])
                ->whereYear('created_at', substr($m,0,4))
                ->whereMonth('created_at', substr($m,5,2))
                ->when($this->startDate, fn($q) => $q->whereDate('created_at', '>=', $this->startDate))
                ->when($this->endDate, fn($q) => $q->whereDate('created_at', '<=', $this->endDate))
                ->count()
        );

        $this->chartLine = ['labels' => $labels, 'values' => $values];
    }

    // -----------------------
    // BAR CHART (STATUS)
    // -----------------------
    protected function loadBarChart()
    {
        $b = $this->bidangValue();
        $base = Pengaduan::whereRaw('LOWER(bidang_tujuan) = ?', [$b])
            ->when($this->startDate, fn($q) => $q->whereDate('created_at', '>=', $this->startDate))
            ->when($this->endDate, fn($q) => $q->whereDate('created_at', '<=', $this->endDate));

        $this->chartBar = [
            'labels' => ['Menunggu','Proses','Selesai'],
            'values' => [
                (clone $base)->where('status','Menunggu')->count(),
                (clone $base)->where('status','Proses')->count(),
                (clone $base)->where('status','Selesai')->count(),
            ]
        ];
    }

    // -----------------------
    // DONUT PERCENTAGE
    // -----------------------
    protected function loadDonutChart()
    {
        $b = $this->bidangValue();
        $total = Pengaduan::whereRaw('LOWER(bidang_tujuan)=?',[$b])
            ->when($this->startDate, fn($q) => $q->whereDate('created_at','>=',$this->startDate))
            ->when($this->endDate, fn($q) => $q->whereDate('created_at','<=',$this->endDate))
            ->count() ?: 1;

        $m = Pengaduan::whereRaw('LOWER(bidang_tujuan)=?',[$b])->where('status','Menunggu')->count();
        $p = Pengaduan::whereRaw('LOWER(bidang_tujuan)=?',[$b])->where('status','Proses')->count();
        $s = Pengaduan::whereRaw('LOWER(bidang_tujuan)=?',[$b])->where('status','Selesai')->count();

        $this->chartDonut = [
            'labels' => ['Menunggu','Proses','Selesai'],
            'values' => [ round($m/$total*100), round($p/$total*100), round($s/$total*100) ]
        ];
    }

    // -----------------------
    // JENIS PENGADUAN (kategori)
    // -----------------------
    protected function loadJenisChart()
    {
        $b = $this->bidangValue();
        $rows = Pengaduan::select('kategori', \DB::raw('COUNT(*) as total'))
            ->whereRaw('LOWER(bidang_tujuan)=?',[$b])
            ->when($this->startDate, fn($q) => $q->whereDate('created_at','>=',$this->startDate))
            ->when($this->endDate, fn($q) => $q->whereDate('created_at','<=',$this->endDate))
            ->groupBy('kategori')
            ->orderByDesc('total')
            ->get();

        $this->chartJenis = ['labels' => $rows->pluck('kategori'), 'values' => $rows->pluck('total')];
    }

    // -----------------------
    // 7 HARI TERAKHIR
    // -----------------------
    protected function load7Hari()
    {
        $b = $this->bidangValue();
        $labels=[]; $values=[];
        for ($i = 6; $i >= 0; $i--) {
            $day = Carbon::today()->subDays($i);
            $labels[] = $day->format('d M');
            $values[] = Pengaduan::whereRaw('LOWER(bidang_tujuan)=?',[$b])
                ->whereDate('created_at',$day->toDateString())
                ->count();
        }
        $this->chart7Hari = ['labels'=>$labels,'values'=>$values];
    }

    // -----------------------
    // TABLE LATEST
    // -----------------------
    protected function loadLatestTable()
    {
        $b = $this->bidangValue();
        $this->latestPengaduan = Pengaduan::whereRaw('LOWER(bidang_tujuan)=?',[$b])
            ->when($this->startDate, fn($q) => $q->whereDate('created_at','>=',$this->startDate))
            ->when($this->endDate, fn($q) => $q->whereDate('created_at','<=',$this->endDate))
            ->latest()
            ->take(10)
            ->get();
    }

    // -----------------------
    // EXPORT CSV (simple, no package)
    // Livewire supports returning streamDownload from action in recent versions.
    // If your Livewire version doesn't trigger download, create a route that calls this logic.
    // -----------------------
    public function exportCsv()
    {
        $b = $this->bidangValue();
        $rows = Pengaduan::whereRaw('LOWER(bidang_tujuan)=?',[$b])
            ->when($this->startDate, fn($q) => $q->whereDate('created_at','>=',$this->startDate))
            ->when($this->endDate, fn($q) => $q->whereDate('created_at','<=',$this->endDate))
            ->orderByDesc('created_at')
            ->get();

        $filename = 'pengaduan_'.$b.'_'.now()->format('Ymd_His').'.csv';

        $callback = function() use ($rows) {
            $out = fopen('php://output', 'w');
            // header
            fputcsv($out, ['id','nama_warga','email','kategori','bidang_tujuan','status','created_at']);
            foreach ($rows as $r) {
                fputcsv($out, [
                    $r->id,
                    $r->nama_warga,
                    $r->email,
                    $r->kategori,
                    $r->bidang_tujuan,
                    $r->status,
                    $r->created_at->toDateTimeString()
                ]);
            }
            fclose($out);
        };

        return Response::streamDownload($callback, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function render()
    {
        return view('livewire.bidang.dashboard-bidang', [
            'stats' => $this->stats,
            'chartLine' => $this->chartLine,
            'chartBar' => $this->chartBar,
            'chartDonut' => $this->chartDonut,
            'chartJenis' => $this->chartJenis,
            'chart7Hari' => $this->chart7Hari,
            'latestPengaduan' => $this->latestPengaduan,
            'colorPresets' => $this->colorPresets,
            'selectedColors' => $this->colorPresets[$this->colorScheme] ?? $this->colorPresets['default'],
        ])->layout('layouts.bidang');
    }
}
