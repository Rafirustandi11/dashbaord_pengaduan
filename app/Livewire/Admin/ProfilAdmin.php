<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilAdmin extends Component
{
    use WithFileUploads;

    public $name, $email, $phone, $alamat;
    public $current_password, $new_password, $confirm_password;
    public $photo, $photoPreview;

    public function mount()
    {
        $user = Auth::user();

        $this->name   = $user->name;
        $this->email  = $user->email;
        $this->phone  = $user->phone;
        $this->alamat = $user->alamat;
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:2048', // 2MB
        ]);

        $this->photoPreview = $this->photo->temporaryUrl();
    }

    public function updateProfile()
    {
        $this->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();

        // ❗ Update Foto
        if ($this->photo) {
            $user->updateProfilePhoto($this->photo);
        }

        // ❗ Update data
        $user->update([
            'name'   => $this->name,
            'email'  => $this->email,
            'phone'  => $this->phone,
            'alamat' => $this->alamat,
        ]);

        session()->flash('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        if (!Hash::check($this->current_password, Auth::user()->password)) {
            session()->flash('error', 'Password lama salah.');
            return;
        }

        Auth::user()->update([
            'password' => Hash::make($this->new_password),
        ]);

        session()->flash('success', 'Password berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.admin.profil-admin')
            ->layout('layouts.admin');
    }
}
