<?php

use App\Http\Controllers\MasterController;
use App\Http\Controllers\ProfileController;
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
});

Route::controller(MasterController::class)->group(function () {
    Route::get('/list_buku', 'list_buku')->name('list_buku');
    Route::get('/list_anggota', 'list_anggota')->name('list_anggota');
    Route::get('/list_pengunjung', 'list_pengunjung')->name('list_pengunjung');
    Route::get('/list_kategori', 'list_kategori')->name('list_kategori');
});


require __DIR__ . '/auth.php';
