<?php

namespace Database\Factories;

use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Anggota;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class PeminjamanFactory extends Factory
{
    protected $model = Peminjaman::class;

    public function definition(): array
    {
        $tanggalPinjam   = $this->faker->dateTimeBetween('-3 months', 'now');
        $tanggalJatuhTempo = Carbon::parse($tanggalPinjam)->addDays(7);
        $status          = $this->faker->randomElement(['dipinjam', 'dikembalikan', 'terlambat']);
        $tanggalKembali  = null;
        $denda           = 0;

        if ($status === 'dikembalikan') {
            $tanggalKembali = $this->faker->dateTimeBetween($tanggalPinjam, $tanggalJatuhTempo);
        } elseif ($status === 'terlambat') {
            $tanggalKembali = $this->faker->dateTimeBetween($tanggalJatuhTempo, '+1 month');
            $hariTerlambat  = Carbon::parse($tanggalKembali)->diffInDays($tanggalJatuhTempo);
            $denda          = $hariTerlambat * 1000;
        }

        return [
            'id_buku'           => Buku::inRandomOrder()->first()?->id,
            'id_anggota'        => Anggota::where('status_aktif', true)->inRandomOrder()->first()?->id,
            'tanggal_pinjam'    => $tanggalPinjam,
            'tanggal_jatuh_tempo'=> $tanggalJatuhTempo,
            'tanggal_kembali'   => $tanggalKembali,
            'status'            => $status,
            'denda'             => $denda,
            'created_at'        => $tanggalPinjam,
            'updated_at'        => now(),
        ];
    }
}