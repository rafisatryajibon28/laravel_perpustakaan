<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Buku::factory(20)->create();

        Anggota::factory(15)->create();

        Peminjaman::factory(10)->create();

        $peminjamanAktif = Peminjaman::whereIn('status', ['dipinjam', 'terlambat'])->get();

        foreach ($peminjamanAktif as $pinjam) {
            $buku = Buku::find($pinjam->id_buku);
            if ($buku) {
                $buku->decrement('stok');
            }
        }
    }
}