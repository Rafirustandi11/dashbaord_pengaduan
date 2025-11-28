<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PengaduanExport;
use App\Models\Pengaduan;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    public function exportExcel(Request $request)
    {
        $bidang = $request->get('bidang');
        $status = $request->get('status');

        return Excel::download(new PengaduanExport($bidang, $status), 'rekap_pengaduan.xlsx');
    }

    public function exportPDF(Request $request)
    {
        $bidang = $request->get('bidang');
        $status = $request->get('status');

        $query = Pengaduan::query();

        if ($bidang) {
            $query->where('bidang_tujuan', $bidang);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $pengaduans = $query->latest()->get();

        $pdf = Pdf::loadView('exports.pengaduan-pdf', [
            'pengaduans' => $pengaduans,
            'bidang' => $bidang,
            'status' => $status,
        ])->setPaper('a4', 'landscape');

        return $pdf->download('rekap_pengaduan.pdf');
    }
}
