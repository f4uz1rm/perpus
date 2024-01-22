<?php

use App\Http\Controllers\MasterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::controller(MasterController::class)->group(function () {
        Route::get('/list_kelas', 'list_kelas')->name('list_kelas');
        Route::get('/list_buku', 'list_buku')->name('list_buku');
        Route::get('/list_anggota', 'list_anggota')->name('list_anggota');
        Route::get('/list_pengunjung', 'list_pengunjung')->name('list_pengunjung');
        Route::get('/list_kategori', 'list_kategori')->name('list_kategori');
    });
    
    Route::controller(TransaksiController::class)->group(function () {
        Route::get('/list_peminjaman', 'list_peminjaman')->name('list_peminjaman');
        Route::get('/form_peminjaman', 'form_peminjaman')->name('form_peminjaman');
        Route::get('/list_pengembalian', 'list_pengembalian')->name('list_pengembalian');
        Route::get('/form_pengembalian', 'form_pengembalian')->name('form_pengembalian');
        Route::get('/list_jadwalkunjungan', 'list_jadwalkunjungan')->name('list_jadwalkunjungan');
        Route::get('/list_denda', 'list_denda')->name('list_denda');
    });
});


require __DIR__ . '/auth.php';
