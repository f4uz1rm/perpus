<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\t_peminjaman;
use App\Models\t_jadwalkunjungan;

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


    function get_jadwalkunjungan(Request $request)
    {
        if ($request->input('id_kunjungan') != null) {
            $data = t_jadwalkunjungan::where('id', $request->input('id_kunjungan'))->get();
        } else {
            $data = t_jadwalkunjungan::all();
        }
        return response()->json([
            'success' => true,
            'message' => 'Data jadwal kunjungan',
            'data' => $data
        ], 200);
    }

    function add_jadwalkunjungan(Request $request)
    {
        $data = new t_jadwalkunjungan();
        $data->nm_lengkap         = $request->input('nm_lengkap');
        $data->tgl_kunjungan      = $request->input('tgl_kunjungan');
        $data->kelas              = $request->input('kelas');
        $data->keterangan              = $request->input('keterangan');
        $data->nm_petugas              = $request->input('nm_petugas');
        $data->save();
        return response()->json([
            'success' => true,
            'message' => 'Berhasil di tambahkan',
            'data' => $data
        ], 200);
    }
    function update_jadwalkunjungan(Request $request)
    {
        $data = t_jadwalkunjungan::find($request->input('id_kunjungan'));
        if ($data) {
            $data->nm_lengkap         = $request->input('nm_lengkap');
            $data->tgl_kunjungan      = $request->input('tgl_kunjungan');
            $data->kelas              = $request->input('kelas');
            $data->keterangan         = $request->input('keterangan');
            $data->nm_petugas         = $request->input('nm_petugas');
            $data->update();
            return response()->json([
                'success' => true,
                'message' => 'Berhasil di update',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal di update',
            ], 200);
        }
    }

    function detele_jadwalkunjungan(Request $request)
    {
        $data = t_jadwalkunjungan::find($request->input('id_kunjungan'));

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak di temukan',
            ], 200);
        } else {
            $data->delete();
            return response()->json([
                'success' => true,
                'message' => 'Berhasil di hapus',
                'data' => $data
            ], 200);
        }
    }
}
