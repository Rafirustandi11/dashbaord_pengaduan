<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class UserManagementTrash extends Component
{
    public $items = [];

    public function mount()
    {
        $this->loadTrash();
    }

    public function loadTrash()
    {
        // 🔥 Ambil semua user bidang yang terhapus (Soft Delete)
        $this->items = User::where('role', 'bidang')
            ->onlyTrashed()
            ->get();
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        session()->flash('success', '♻️ Akun berhasil dipulihkan.');
        $this->loadTrash();
    }

    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();

        session()->flash('success', '❌ Akun berhasil dihapus permanen.');
        $this->loadTrash();
    }

    public function emptyTrash()
    {
        User::onlyTrashed()
            ->where('role', 'bidang')
            ->forceDelete();

        session()->flash('success', '🗑️ Semua akun di sampah telah dihapus permanen.');
        $this->loadTrash();
    }

    public function render()
    {
        return view('livewire.admin.user-management-trash', [
            'items' => $this->items
        ])->layout('layouts.admin');
    }
}
