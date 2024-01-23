<?php

use App\Http\Controllers\API\MasterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(MasterController::class)->group(function () {
    Route::get('/get_pengunjung', 'get_pengunjung');
    Route::post('/add_pengunjung', 'add_pengunjung');
    
    Route::get('/get_kelas', 'get_kelas');
    Route::post('/add_kelas', 'add_kelas');
    Route::put('/update_kelas', 'update_kelas');
    Route::delete('/delete_kelas', 'delete_kelas');

    Route::get('/get_anggota', 'get_anggota');
    Route::post('/add_anggota', 'add_anggota');
    Route::put('/update_anggota', 'update_anggota');
    Route::delete('/delete_anggota', 'delete_anggota');

    Route::get('/get_kategori', 'get_kategori');
    Route::post('/add_kategori', 'add_kategori');
    Route::put('/update_kategori', 'update_kategori');
    Route::delete('/delete_kategori', 'delete_kategori');

    Route::get('/get_buku', 'get_buku');
    Route::post('/add_buku', 'add_buku');
    Route::put('/update_buku', 'update_buku');
    Route::delete('/delete_buku', 'delete_buku');

    Route::get('/get_rak', 'get_rak');
    Route::post('/add_rak', 'add_rak');
    Route::put('/update_rak', 'update_rak');
    Route::delete('/delete_rak', 'delete_rak');
});
