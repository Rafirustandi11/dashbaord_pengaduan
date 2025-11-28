<?php

namespace App\Livewire;

use Livewire\Component;

class ToggleTheme extends Component
{
    public $theme = 'light';

    public function mount()
    {
        // Ambil dari session jika ada
        $this->theme = session('theme', 'light');
    }

    public function toggleTheme()
    {
        // Ganti theme
        $this->theme = $this->theme === 'light' ? 'dark' : 'light';

        // Simpan ke session
        session(['theme' => $this->theme]);

        // Kirim event ke browser (Livewire v3)
        $this->dispatch('theme-changed', theme: $this->theme);
    }

    public function render()
    {
        return view('livewire.toggle-theme');
    }
}
