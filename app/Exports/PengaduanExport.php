<?php

namespace App\Exports;

use App\Models\Pengaduan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PengaduanExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $bidang;
    protected $status;

    public function __construct($bidang = null, $status = null)
    {
        $this->bidang = $bidang;
        $this->status = $status;
    }

    public function collection()
    {
        $query = Pengaduan::query();

        if ($this->bidang) {
            $query->where('bidang_tujuan', $this->bidang);
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        return $query->latest()->get();
    }

    public function headings(): array
    {
        return [
            'Nama Warga',
            'Email',
            'Kategori Pengaduan',
            'Bidang Tujuan',
            'Status',
            'Tanggal Masuk',
            'Tanggal Selesai',
        ];
    }

    public function map($p): array
    {
        return [
            $p->nama_warga ?? '-',
            $p->email ?? '-',
            $p->kategori ?? '-',
            $p->bidang_tujuan ? ucwords($p->bidang_tujuan) : '-',
            $p->status ?? '-',
            $p->created_at ? $p->created_at->format('d-m-Y') : '-',
            $p->tanggal_selesai ? $p->tanggal_selesai->format('d-m-Y') : '-',  
        ];
    }
}
