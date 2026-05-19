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
            'no_hp'           => 'required|string|max:20',
            'kategori'        => 'required|string',
            'lokasi_kejadian' => 'nullable|string|max:255',
            'isi_laporan'     => 'required|string',
            'lampiran'        => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'bidang_tujuan'   => 'nullable|string|in:egov,itik,statistik,persandian,pikp',
        ]);

        // Handle upload lampiran
        $lampiranPath = null;
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('lampiran', 'public');
        }

        // Generate kode pengaduan unik
        // withTrashed() agar kode tidak bentrok dengan data yang sudah dihapus
        $tahun  = date('Y');
        $bulan  = date('m');
        $urutan = Pengaduan::withTrashed()->whereYear('created_at', $tahun)->count() + 1;
        $kode   = 'ADU-' . $tahun . $bulan . '-' . str_pad($urutan, 4, '0', STR_PAD_LEFT);

        // Pastikan kode benar-benar unik (fallback jika ada tabrakan)
        while (Pengaduan::withTrashed()->where('kode_pengaduan', $kode)->exists()) {
            $urutan++;
            $kode = 'ADU-' . $tahun . $bulan . '-' . str_pad($urutan, 4, '0', STR_PAD_LEFT);
        }

        Pengaduan::create([
            'kode_pengaduan'  => $kode,
            'nama_warga'      => $request->nama_warga,
            'email'           => $request->email,
            'no_hp'           => $request->no_hp,
            'kategori'        => $request->kategori,
            'lokasi_kejadian' => $request->lokasi_kejadian,
            'isi_laporan'     => $request->isi_laporan,
            'lampiran'        => $lampiranPath,
            'bidang_tujuan'   => $request->bidang_tujuan
                                    ? strtolower($request->bidang_tujuan)
                                    : null,
            'status'          => 'Menunggu',
        ]);

        // Simpan kode ke session untuk ditampilkan di halaman sukses
        session(['kode_pengaduan_baru' => $kode]);

        return redirect()->route('pengaduan.sukses');
    }

    // Tampilkan form cek status
public function cekForm()
{
    return view('pengaduan.cek');
}

// Proses pencarian
// Proses pencarian
public function cekHasil(Request $request)
{
    $request->validate([
        'kode_pengaduan' => 'required|string',
        'no_hp'          => 'required|string',
    ], [
        'kode_pengaduan.required' => 'Kode pengaduan wajib diisi.',
        'no_hp.required'          => 'Nomor HP wajib diisi.',
    ]);

    // Normalisasi kode pengaduan
    $kode = strtoupper(trim($request->kode_pengaduan));

    // Normalisasi no HP — hapus spasi, strip, titik
    $hp = preg_replace('/[\s\-\.]/', '', trim($request->no_hp));

    // Normalkan awalan: +62xxx / 62xxx → 08xxx
    $hp = preg_replace('/^\+?62/', '0', $hp);

    $pengaduan = Pengaduan::where('kode_pengaduan', $kode)
        ->where(function ($q) use ($hp) {
            $q->where('no_hp', $hp)
              ->orWhere('no_hp', preg_replace('/^0/', '62', $hp))
              ->orWhere('no_hp', preg_replace('/^0/', '+62', $hp));
        })
        ->first();

    if (!$pengaduan) {
        return back()->withErrors([
            'not_found' => 'Pengaduan tidak ditemukan. Pastikan kode dan nomor HP sesuai.'
        ])->withInput();
    }

    return view('pengaduan.cek', compact('pengaduan'));
}

    // Halaman sukses setelah submit (non-login)
    public function sukses()
    {
        return view('pengaduan.sukses');
    }
}