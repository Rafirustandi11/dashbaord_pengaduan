<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Pengaduan;
use App\Models\FormField;
use Illuminate\Support\Str;

class PengaduanCreate extends Component
{
    use WithFileUploads;

    public $formFields = [];
    public $inputs = []; // semua input user disimpan di array dinamis
    public $files = []; // untuk menyimpan file upload

    public function mount()
    {
        // Ambil semua field aktif dari database
        $this->formFields = FormField::where('active', true)
            ->orderBy('order')
            ->get();

        // Inisialisasi setiap input agar tidak error di wire:model
        foreach ($this->formFields as $field) {
            if ($field->type === 'file') {
                $this->files[$field->name] = null;
            } else {
                $this->inputs[$field->name] = '';
            }
        }
    }

   public function submit()
{
    // Validasi dinamis
    $rules = [];
    foreach ($this->formFields as $field) {
        if ($field->required) {
            if ($field->type === 'file') {
                $rules["files.{$field->name}"] = 'required|file|max:2048';
            } else {
                $rules["inputs.{$field->name}"] = 'required';
            }
        }
    }
    $this->validate($rules);

    // Generate kode
    $kode = 'PGD-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));

    // Siapkan data
    $data = [
        'kode'          => $kode,
        'status'        => 'Menunggu',
        'bidang_tujuan' => null,
    ];

    foreach ($this->inputs as $key => $value) {
        if (in_array($key, (new Pengaduan())->getFillable())) {
            $data[$key] = $value;
        }
    }

    // Upload file
    foreach ($this->files as $key => $file) {
        if ($file) {
            $filename = $kode . '_' . $key . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('pengaduan', $filename, 'public');
            $data[$key] = $path;
        }
    }

    Pengaduan::create($data);

    // 🔥 Reset form + inisialisasi ulang field supaya tidak undefined
    $this->inputs = [];
    $this->files = [];

    foreach ($this->formFields as $field) {
        if ($field->type === 'file') {
            $this->files[$field->name] = null;
        } else {
            $this->inputs[$field->name] = '';
        }
    }

    $this->resetErrorBag();
    $this->resetValidation();

    session()->flash('success', 'Pengaduan Anda berhasil dikirim.');
}

    public function render()
    {
        return view('livewire.pengaduan-create', [
            'formFields' => $this->formFields
        ])->layout('layouts.guest');
    }
}
