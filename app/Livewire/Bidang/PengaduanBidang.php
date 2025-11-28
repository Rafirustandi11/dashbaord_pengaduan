<?php

namespace App\Livewire\Bidang;

use Livewire\Component;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BalasanPengaduanMail;

class PengaduanBidang extends Component
{
    public $pengaduans;
    public $tanggapan, $pengaduanId;
    public $isModalOpen = false;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $bidang = strtolower(Auth::user()->bidang);
        $this->pengaduans = Pengaduan::whereRaw('LOWER(bidang_tujuan) = ?', [$bidang])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function openModal($id)
    {
        $this->pengaduanId = $id;
        $this->isModalOpen = true;
        $this->tanggapan = Pengaduan::find($id)->tanggapan_bidang;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function ubahStatus($id, $status)
    {
        $pengaduan = Pengaduan::find($id);
        if (!$pengaduan) {
            return;
        }

        if (strtolower($pengaduan->bidang_tujuan) !== strtolower(Auth::user()->bidang)) {
            session()->flash('error', 'Anda tidak berhak mengubah pengaduan ini.');
            return;
        }

        $pengaduan->status = $status;

        if ($status === 'Selesai') {
            $pengaduan->tanggal_selesai = now();
        }

        $pengaduan->save();
        $pengaduan->refresh(); // PENTING

        // KIRIM EMAIL
        if ($pengaduan->email) {
            Mail::to($pengaduan->email)->send(new BalasanPengaduanMail($pengaduan));
        }

        session()->flash('message', "Status pengaduan berhasil diubah menjadi {$status}.");
        $this->loadData();
    }

    public function simpanTanggapan()
    {
        $pengaduan = Pengaduan::find($this->pengaduanId);
        $pengaduan->tanggapan_bidang = $this->tanggapan;
        $pengaduan->save();
        $pengaduan->refresh(); // PENTING

        // EMAIL SETELAH BALASAN DIBERIKAN
        if ($pengaduan->email) {
            Mail::to($pengaduan->email)->send(new BalasanPengaduanMail($pengaduan));
        }

        session()->flash('message', 'Tanggapan bidang berhasil disimpan.');
        $this->closeModal();
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.bidang.pengaduan-bidang', [
            'pengaduans' => $this->pengaduans,
        ])->layout('layouts.bidang');
    }
}
