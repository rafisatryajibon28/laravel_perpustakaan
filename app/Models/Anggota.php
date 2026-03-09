<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis', 'nama_lengkap', 'kelas', 'jenis_kelamin', 'alamat',
        'no_telepon', 'email', 'tanggal_daftar', 'status_aktif'
    ];

    protected $casts = [
        'tanggal_daftar' => 'date',
        'status_aktif' => 'boolean',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_anggota');
    }

    public function scopeAktif($query)
    {
        return $query->where('status_aktif', true);
    }

    public function getTanggalDaftarFormattedAttribute()
    {
        return $this->tanggal_daftar?->format('d/m/Y');
    }
}