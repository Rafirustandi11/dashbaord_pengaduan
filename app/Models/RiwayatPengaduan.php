<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPengaduan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_pengaduan';

    protected $fillable = [
        'pengaduan_id',
        'status',
        'created_by',
        'updated_by',
    ];

    // relasi ke tabel pengaduan
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id');
    }

    // relasi ke user yang membuat riwayat
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // relasi ke user yang terakhir update
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
