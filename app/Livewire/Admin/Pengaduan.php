<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Pengaduan as PengaduanModel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\BalasanPengaduanMail;

class Pengaduan extends Component
{
    public $pengaduans = [];
    public $nama_warga, $email, $kategori, $isi_laporan;
    public $balasan, $status, $lampiran, $tanggapan_bidang, $bidang_tujuan;
    public $pengaduanId;
    public $isModalOpen = false;
    public $mode = 'create';
    public $search = '',
        $filterStatus = 'semua';

    public $selectedPengaduan = null;

    protected $listeners = ['refreshPengaduans' => 'loadData'];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $query = PengaduanModel::query()->latest();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nama_warga', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%")
                    ->orWhere('isi_laporan', 'like', "%{$this->search}%");
            });
        }

        if ($this->filterStatus !== 'semua') {
            $query->where('status', $this->filterStatus);
        }

        $this->pengaduans = $query->get();
    }

    public function updatedSearch()
    {
        $this->loadData();
    }
    public function updatedFilterStatus()
    {
        $this->loadData();
    }

    public function resetInput()
    {
        $this->nama_warga = $this->email = $this->kategori = $this->isi_laporan = '';
        $this->balasan = $this->tanggapan_bidang = '';
        $this->status = 'Menunggu';
        $this->lampiran = null;
        $this->bidang_tujuan = null;
        $this->pengaduanId = null;
    }

    public function openModal(string $mode, ?int $id = null)
    {
        $this->mode = $mode;

        if ($mode === 'create') {
            $this->resetInput();
        } else {
            $p = PengaduanModel::findOrFail($id);

            $this->pengaduanId = $p->id;
            $this->nama_warga = $p->nama_warga;
            $this->email = $p->email;
            $this->kategori = $p->kategori;
            $this->isi_laporan = $p->isi_laporan;
            $this->balasan = $p->balasan;
            $this->status = $p->status;
            $this->lampiran = $p->lampiran;
            $this->tanggapan_bidang = $p->tanggapan_bidang;
            $this->bidang_tujuan = $p->bidang_tujuan;
        }

        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function lihatLaporan($id)
    {
        $this->selectedPengaduan = PengaduanModel::findOrFail($id);
    }

    public function closeLaporan()
    {
        $this->selectedPengaduan = null;
    }

    public function update()
    {
        $this->validate([
            'status' => 'required|string',
        ]);

        $p = PengaduanModel::findOrFail($this->pengaduanId);

        if ($this->status === 'Diteruskan ke Bidang' && empty($this->bidang_tujuan)) {
            session()->flash('error', 'Pilih bidang tujuan sebelum meneruskan pengaduan.');
            return;
        }

        $bidang = $this->bidang_tujuan ? Str::lower($this->bidang_tujuan) : $p->bidang_tujuan;

        // UPDATE DATA
        $p->update([
            'balasan' => $this->balasan,
            'status' => $this->status,
            'bidang_tujuan' => $bidang,
            'tanggapan_admin' => $this->tanggapan_bidang,
            'tanggal_disposisi' => $this->status === 'Diteruskan ke Bidang' ? now() : $p->tanggal_disposisi,
        ]);

        // PASTIKAN DATA TERBARU 100%
        $p->refresh();

        // KIRIM EMAIL KEPADA PELAPOR
        if ($p->email) {
            Mail::to($p->email)->send(new BalasanPengaduanMail($p));
        }

        session()->flash('message', 'Pengaduan berhasil diperbarui.');
        $this->closeModal();
        $this->loadData();
        $this->dispatch('refreshPengaduans');
    }

    public function delete($id)
    {
        $p = PengaduanModel::find($id);

        if ($p) {
            $p->delete();
            session()->flash('message', 'Pengaduan dipindahkan ke sampah!');
        }

        $this->loadData();
    }

    public function render()
    {
        $bidangs = ['Egov', 'Itik', 'Statistik', 'Persandian', 'Pikp'];

        return view('livewire.admin.pengaduan', [
            'pengaduans' => $this->pengaduans,
            'bidangs' => $bidangs,
        ])->layout('layouts.admin');
    }
}
