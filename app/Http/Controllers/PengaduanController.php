<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    // Form Pengaduan
    public function create()
    {
        $bidangs = ['egov', 'itik', 'statistik', 'persandian', 'pikp'];
        return view('pengaduan.form', compact('bidangs'));
    }

    // Simpan Pengaduan
    public function store(Request $request)
    {
        $request->validate([
            'nama_warga'      => 'required|string|max:255',
            'email'           => 'nullable|email|max:255',
            'kategori'        => 'required|string',
            'isi_laporan'     => 'required|string',
            'bidang_tujuan'   => 'nullable|string|in:egov,itik,statistik,persandian,pikp',
        ]);

        Pengaduan::create([
            'nama_warga'     => $request->nama_warga,
            'email'          => $request->email,
            'kategori'       => $request->kategori,
            'isi_laporan'    => $request->isi_laporan,
            'bidang_tujuan'  => $request->bidang_tujuan ? strtolower($request->bidang_tujuan) : null,
            'status'         => 'Menunggu',
        ]);

        return redirect()->back()->with('success', 'Pengaduan berhasil dikirim.');
    }
}
