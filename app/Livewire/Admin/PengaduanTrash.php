<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Pengaduan;

class PengaduanTrash extends Component
{
    public $items = [];
    public $countActive = 0;
    public $countTrash = 0;

    protected $listeners = ['refreshTrash' => 'loadData'];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->items = Pengaduan::onlyTrashed()
            ->orderBy('deleted_at', 'DESC')
            ->get();

        $this->countActive = Pengaduan::count();
        $this->countTrash = Pengaduan::onlyTrashed()->count();
    }

    public function restore($id)
    {
        Pengaduan::withTrashed()->findOrFail($id)->restore();

        session()->flash('message', '♻️ Pengaduan berhasil dipulihkan!');
        $this->loadData();
    }

    public function forceDelete($id)
    {
        Pengaduan::withTrashed()->findOrFail($id)->forceDelete();

        session()->flash('message', '❌ Pengaduan berhasil dihapus permanen!');
        $this->loadData();
    }

    public function emptyTrash()
    {
        Pengaduan::onlyTrashed()->forceDelete();

        session()->flash('message', '🗑️ Semua pengaduan sampah telah dihapus permanen!');
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.admin.pengaduan-trash', [
            'items' => $this->items,
            'countActive' => $this->countActive,
            'countTrash' => $this->countTrash,
        ])->layout('layouts.admin', [
            'title' => 'Sampah Pengaduan',
        ]);
    }
}
