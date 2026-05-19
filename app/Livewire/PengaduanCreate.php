<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Pengaduan;
use App\Models\FormField;

class PengaduanCreate extends Component
{
    use WithFileUploads;

    public $formFields = [];
    public $inputs = [];
    public $files = [];

    public function mount()
    {
        $this->formFields = FormField::where('active', true)
            ->orderBy('order')
            ->get();

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
                    $rules["files.{$field->name}"] = 'required|file|mimes:jpg,jpeg,png,pdf|max:2048';
                } else {
                    $rules["inputs.{$field->name}"] = 'required';
                }
            }
        }
        $this->validate($rules);

        // Generate kode pengaduan unik (format: ADU-202505-0001)
        $tahun  = date('Y');
        $bulan  = date('m');
        $urutan = Pengaduan::withTrashed()->whereYear('created_at', $tahun)->count() + 1;
        $kode   = 'ADU-' . $tahun . $bulan . '-' . str_pad($urutan, 4, '0', STR_PAD_LEFT);

        // Pastikan kode benar-benar unik
        while (Pengaduan::withTrashed()->where('kode_pengaduan', $kode)->exists()) {
            $urutan++;
            $kode = 'ADU-' . $tahun . $bulan . '-' . str_pad($urutan, 4, '0', STR_PAD_LEFT);
        }

        // Siapkan data — hanya kolom yang ada di $fillable
        $fillable = (new Pengaduan())->getFillable();
        $data = [
            'kode_pengaduan' => $kode,      // ← fix: sebelumnya 'kode'
            'status'         => 'Menunggu',
            'bidang_tujuan'  => null,
        ];

        foreach ($this->inputs as $key => $value) {
            if (in_array($key, $fillable)) {
                $data[$key] = $value;
            }
        }

        // Upload file
        foreach ($this->files as $key => $file) {
            if ($file && in_array($key, $fillable)) {
                $filename = $kode . '_' . $key . '.' . $file->getClientOriginalExtension();
                $path     = $file->storeAs('pengaduan', $filename, 'public');
                $data[$key] = $path;
            }
        }

        Pengaduan::create($data);

        // Simpan kode ke session → ditampilkan di halaman sukses
        session(['kode_pengaduan_baru' => $kode]);

        // Redirect ke halaman sukses
        return redirect()->route('pengaduan.sukses');
    }

    public function render()
    {
        return view('livewire.pengaduan-create', [
            'formFields' => $this->formFields,
        ])->layout('layouts.guest');
    }
}