<?php

namespace App\Livewire\Bidang;

use Livewire\Component;
use App\Models\Pengaduan;

class EditPengaduan extends Component
{
    public $pengaduan;
    public $tanggapan_bidang;

    public function mount($id)
    {
        $this->pengaduan = Pengaduan::findOrFail($id);
        $this->tanggapan_bidang = $this->pengaduan->tanggapan_bidang;
    }

    public function simpanTanggapan()
    {
        $this->validate([
            'tanggapan_bidang' => 'nullable|string|max:5000',
        ]);

        $this->pengaduan->tanggapan_bidang = $this->tanggapan_bidang;

        // Jika bidang memberi tanggapan, ubah status otomatis ke "Proses"
        if ($this->pengaduan->status === 'Diteruskan ke Bidang') {
            $this->pengaduan->status = 'Proses';
        }

        $this->pengaduan->save();
        session()->flash('message', 'Tanggapan bidang berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.bidang.edit-pengaduan')->layout('layouts.bidang');
    }
}
