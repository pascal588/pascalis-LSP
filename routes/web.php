<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::middleware('role:admin')->group(function () {
        // Rute Kategori //
        Route::get('/kategori', [KategoriController::class, 'indeks'])->name('kategori.indeks');
        Route::get('/kategori/tambah', [KategoriController::class, 'tambah'])->name('kategori.tambah');
        Route::post('/kategori', [KategoriController::class, 'simpan'])->name('kategori.simpan');
        Route::get('/kategori/{category}/ubah', [KategoriController::class, 'ubah'])->name('kategori.ubah');
        Route::patch('/kategori/{category}', [KategoriController::class, 'perbarui'])->name('kategori.perbarui');
        Route::delete('/kategori/{category}', [KategoriController::class, 'hapus'])->name('kategori.hapus');

        // Rute Barang //
        Route::get('/barang', [BarangController::class, 'indeks'])->name('barang.indeks');
        Route::get('/barang/tambah', [BarangController::class, 'tambah'])->name('barang.tambah');
        Route::post('/barang', [BarangController::class, 'simpan'])->name('barang.simpan');
        Route::get('/barang/{item}/ubah', [BarangController::class, 'ubah'])->name('barang.ubah');
        Route::patch('/barang/{item}', [BarangController::class, 'perbarui'])->name('barang.perbarui');
        Route::delete('/barang/{item}', [BarangController::class, 'hapus'])->name('barang.hapus');
    });

    // Rute Transaksi //
    Route::get('/transaksi', [TransaksiController::class, 'indeks'])->name('transaksi.indeks');
    Route::post('/transaksi/tambah-keranjang', [TransaksiController::class, 'tambahKeranjang'])->name('transaksi.tambah-keranjang');
    Route::get('/transaksi/keranjang', [TransaksiController::class, 'keranjang'])->name('transaksi.keranjang');
    Route::delete('/transaksi/keranjang/{id}', [TransaksiController::class, 'hapusKeranjang'])->name('transaksi.hapus-keranjang');
    Route::post('/transaksi/bayar', [TransaksiController::class, 'bayar'])->name('transaksi.bayar');
    Route::get('/transaksi/riwayat', [TransaksiController::class, 'riwayat'])->name('transaksi.riwayat');
    Route::get('/transaksi/{transaction}/struk', [TransaksiController::class, 'struk'])->name('transaksi.struk');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
