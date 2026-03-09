<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AuthController;

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth.custom')->group(function () {
    Route::get('/', function () {
        $totalBuku = \App\Models\Buku::count();
        $totalAnggotaAktif = \App\Models\Anggota::aktif()->count();
        $bukuDipinjam = \App\Models\Peminjaman::whereIn('status', ['dipinjam', 'terlambat'])->count();
        $peminjamanTerbaru = \App\Models\Peminjaman::with(['buku', 'anggota'])->latest()->take(5)->get();

        return view('dashboard', compact('totalBuku', 'totalAnggotaAktif', 'bukuDipinjam', 'peminjamanTerbaru'));
    })->name('dashboard');


    Route::resource('buku', BukuController::class);
    Route::resource('peminjaman', PeminjamanController::class);

    Route::resource('anggota', AnggotaController::class);

    Route::get('peminjaman/{id}/kembali', [PeminjamanController::class, 'kembali'])
        ->name('peminjaman.kembali');

    Route::get('laporan/peminjaman', [PeminjamanController::class, 'laporan'])
        ->name('peminjaman.laporan');
});