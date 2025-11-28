<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bidang extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bidangs';

    protected $fillable = [
        'nama_bidang',
        'deskripsi',
    ];

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'kategori', 'nama_bidang');
    }
}
