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
        'nama_warga',
        'email',
        'kategori',
        'bidang_tujuan',
        'isi_laporan',
        'balasan',
        'status',
        'tanggapan_bidang',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'tanggal_masuk' => 'datetime',
        'tanggal_selesai' => 'datetime',
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

        $endDate = $this->updated_at ?? Carbon::now();
        return $this->created_at->diffInDays($endDate) . ' hari';
    }
}
