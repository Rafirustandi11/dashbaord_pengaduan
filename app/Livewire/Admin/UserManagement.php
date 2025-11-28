<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserManagement extends Component
{
    public $users;
    public $name, $email, $password, $bidang;
    public $editMode = false;
    public $userId;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'password' => 'nullable|min:6',
        'bidang' => 'required|string|max:255',
    ];

    public function render()
    {
        $this->users = User::where('role', 'bidang')->get();
        return view('livewire.admin.user-management')->layout('layouts.admin');
    }

    public function resetForm()
    {
        $this->reset(['name', 'email', 'password', 'bidang', 'userId', 'editMode']);
    }

    public function store()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password ?? 'password'),
            'role' => 'bidang',
            'bidang' => $this->bidang,
        ]);

        session()->flash('success', '✅ Akun bidang berhasil ditambahkan.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->bidang = $user->bidang;
        $this->editMode = true;
    }

    public function update()
    {
        $this->validate();

        $user = User::findOrFail($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'bidang' => $this->bidang,
            'password' => $this->password ? Hash::make($this->password) : $user->password,
        ]);

        session()->flash('success', '✅ Akun bidang berhasil diperbarui.');
        $this->resetForm();
    }

    // ✅ Soft Delete (menandai deleted_at, bukan hapus permanen)
    public function delete($id)
    {
        $user = User::where('role', 'bidang')->findOrFail($id);
        $user->delete();

        session()->flash('success', '🗑️ Akun bidang berhasil dipindahkan ke sampah.');
    }
    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'password' => Hash::make('password'),
        ]);

        session()->flash('success', "🔑 Password untuk {$user->name} telah direset ke 'password'.");
    }
}
