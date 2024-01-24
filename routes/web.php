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

Route::controller(MasterController::class)->group(function () {
    Route::get('/view_pengunjung', 'view_pengunjung')->name('view_pengunjung');
    Route::post('/tambah_pengunjung', 'tambah_pengunjung')->name('tambah_pengunjung');
    Route::get('/get_kelas', 'get_kelas')->name('get_kelas');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(MasterController::class)->group(function () {
        Route::get('/list_kelas', 'list_kelas')->name('list_kelas');
        Route::post('/add_kelas', 'add_kelas')->name('add_kelas');
        Route::put('/update_kelas', 'update_kelas')->name('update_kelas');
        Route::delete('/delete_kelas', 'delete_kelas')->name('delete_kelas');


        Route::get('/list_buku', 'list_buku')->name('list_buku');
        Route::get('/get_buku', 'get_buku')->name('get_buku');
        Route::post('/add_buku', 'add_buku')->name('get_buku');
        Route::put('/update_buku', 'update_buku')->name('get_buku');
        Route::delete('/delete_buku', 'delete_buku')->name('get_buku');


        Route::get('/list_anggota', 'list_anggota')->name('list_anggota');
        Route::post('/add_anggota', 'add_anggota')->name('add_anggota');
        Route::put('/update_anggota', 'update_anggota')->name('update_anggota');
        Route::delete('/delete_anggota', 'delete_anggota')->name('delete_anggota');


        Route::get('/list_kategori', 'list_kategori')->name('list_kategori');
        Route::post('/add_kategori', 'add_kategori')->name('add_kategori');
        Route::put('/update_kategori', 'update_kategori')->name('update_kategori');
        Route::delete('/delete_kategori', 'delete_kategori')->name('delete_kategori');

        Route::get('/list_pengunjung', 'list_pengunjung')->name('list_pengunjung');
        Route::get('/get_pengunjung', 'get_pengunjung')->name('get_pengunjung');
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
