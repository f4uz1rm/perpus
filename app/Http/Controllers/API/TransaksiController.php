<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\t_peminjaman;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    function add_peminjaman(Request $request)
    {
        $data = new t_peminjaman();
        $data->id_kelas           = $request->input('id_kelas');
        $data->tgl_pinjam         = $request->input('tgl_pinjam');
        $data->tgl_kembali        = $request->input('tgl_kembali');
        $data->id_anggota         = $request->input('id_anggota');
        $data->id_petugas         = $request->input('id_petugas');
        // $data->id_buku            = $request->input('id_buku');

        return $data;
        // $data->save();
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Berhasil di tambahkan',
        //     'data' => $data
        // ], 200);
    }
}
