<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Peminjaman extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_buku', 'id_anggota', 'tanggal_pinjam', 'tanggal_jatuh_tempo',
        'tanggal_kembali', 'status', 'denda'
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_jatuh_tempo' => 'date',
        'tanggal_kembali' => 'date',
        'denda' => 'decimal:2',
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota');
    }

    public function scopeAktif($query)
    {
        return $query->whereIn('status', ['dipinjam', 'terlambat']);
    }

    public function hitungDenda()
    {
        if (!$this->tanggal_kembali || $this->tanggal_kembali <= $this->tanggal_jatuh_tempo) {
            return 0;
        }
        $hariTerlambat = $this->tanggal_kembali->diffInDays($this->tanggal_jatuh_tempo);
        return $hariTerlambat * 1000;
    }
}