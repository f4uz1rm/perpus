<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\t_peminjaman;
use App\Models\t_jadwalkunjungan;
use App\Models\t_peminjaman_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    function get_peminjaman(Request $request)
    {
        if ($request->input('id_peminjaman') != null) {
            $data = t_peminjaman::where('id', $request->input('id_peminjaman'))->get();
        } else {
            $data = t_peminjaman::leftJoin('m_kelas', 'm_kelas.id', '=', 't_peminjaman.id_kelas')
                ->leftJoin('m_anggota', 'm_anggota.id', '=', 't_peminjaman.id_anggota')
                ->select('t_peminjaman.*', 'm_kelas.nm_kelas', 'm_anggota.nm_lengkap')
                ->get()->toArray();

            $list_buku = t_peminjaman_detail::select("kd_buku", "qty")->where('id', $data[0]['id'])->get();
            
            $data["list_buku"] = [];

            foreach ($list_buku as $value) {
                $data["list_buku"][] = $value;
            }
        }
        return response()->json([
            'success'   => true,
            'message'   => 'Data peminjaman',
            'data'      => $data,
        ], 200);
    }


    function get_jadwalkunjungan(Request $request)
    {
        if ($request->input('id_kunjungan') != null) {
            $data = t_jadwalkunjungan::where('id', $request->input('id_kunjungan'))->get();
        } else {
            $data = t_jadwalkunjungan::leftJoin('m_kelas', 'm_kelas.id', '=', 't_jadwalkunjungan.id_kelas')
                ->select('t_jadwalkunjungan.*', 'm_kelas.nm_kelas')
                ->get();
        }
        return response()->json([
            'success'   => true,
            'message'   => 'Data jadwal kunjungan',
            'data'      => $data
        ], 200);
    }

    function add_jadwalkunjungan(Request $request)
    {
        $data = new t_jadwalkunjungan();
        $data->tgl_kunjungan            = $request->input('tgl_kunjungan');
        $data->id_kelas                 = $request->input('id_kelas');
        $data->keterangan               = $request->input('keterangan');
        $data->nm_petugas               = $request->input('nm_petugas');
        $data->save();
        return response()->json([
            'success'   => true,
            'message'   => 'Berhasil di tambahkan',
            'data'      => $data
        ], 200);
    }
    function update_jadwalkunjungan(Request $request)
    {
        $data = t_jadwalkunjungan::find($request->input('id_kunjungan'));
        if ($data) {
            $data->tgl_kunjungan            = $request->input('tgl_kunjungan');
            $data->id_kelas                 = $request->input('id_kelas');
            $data->keterangan               = $request->input('keterangan');
            $data->nm_petugas               = $request->input('nm_petugas');
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

    function delete_jadwalkunjungan(Request $request)
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
