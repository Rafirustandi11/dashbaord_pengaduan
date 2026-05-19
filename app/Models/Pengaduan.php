<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Pengaduan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pengaduans';

    protected $fillable = [
        'kode_pengaduan',
        'nama_warga',
        'email',
        'no_hp',
        'kategori',
        'lokasi_kejadian',
        'bidang_tujuan',
        'isi_laporan',
        'lampiran',
        'balasan',
        'status',
        'tanggapan',
        'tanggapan_admin',
        'tanggapan_bidang',
        'tanggal_disposisi',
        'tanggal_selesai',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
        'tanggal_masuk'     => 'datetime',
        'tanggal_disposisi' => 'datetime',
        'tanggal_selesai'   => 'datetime',
    ];

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_tujuan', 'nama_bidang');
    }

    public function getDurasiAttribute()
    {
        if (!$this->created_at) {
            return null;
        }

        $endDate = $this->tanggal_selesai ?? $this->updated_at ?? Carbon::now();
        return $this->created_at->diffInDays($endDate) . ' hari';
    }
}