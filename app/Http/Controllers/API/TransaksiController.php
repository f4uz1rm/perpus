<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\t_denda;
use App\Models\t_peminjaman;
use App\Models\t_jadwalkunjungan;
use App\Models\t_peminjaman_detail;
use App\Models\t_pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $id_buku                  = $request->input('id_buku');
        $data->save();
        foreach ($id_buku as $value) {
            $detail = new t_peminjaman_detail();
            $detail->id = $data->id;
            $detail->kd_buku = $value['kd_buku'];
            $detail->qty = $value['qty'];
            $detail->timestamps = false;
            $detail->save();
        }
        return response()->json([
            'success' => true,
            'message' => 'Berhasil di tambahkan',
            'id' => $data->id
        ], 200);
    }




    function add_pengembalian(Request $request)
    {
        $get_peminjaman = t_peminjaman::where('id_anggota', $request->input('id_anggota'))->get();
        $get_peminjaman_detail = t_peminjaman_detail::where('id', $get_peminjaman[0]->id)->get();

        if ($get_peminjaman && $get_peminjaman_detail) {

            DB::table('t_log_peminjaman')->insert([
                'id_kelas' => $get_peminjaman[0]->id_kelas,
                'tgl_pinjam' => $get_peminjaman[0]->tgl_pinjam,
                'tgl_kembali' => $get_peminjaman[0]->tgl_kembali,
                'id_anggota' => $get_peminjaman[0]->id_anggota,
                'id_petugas' => $get_peminjaman[0]->id_petugas,
                'created_at' => $get_peminjaman[0]->created_at,
                'updated_at' => $get_peminjaman[0]->updated_at
            ]);

            $t_pengembalian = new t_pengembalian();
            $t_pengembalian->id_pinjam = $get_peminjaman[0]->id;
            $t_pengembalian->id_anggota = $get_peminjaman[0]->id_anggota;
            $t_pengembalian->keterangan = $request->input('keterangan');
            $t_pengembalian->tgl_kembali = $request->input('tgl_kembali');
            $t_pengembalian->denda = $request->input('denda');
            $t_pengembalian->id_petugas = $request->input('id_petugas');
            $t_pengembalian->save();


            $t_denda = new t_denda();
            if ($request->input('denda') == !"" || $request->input('denda') == !null) {
                $t_denda->id_anggota = $get_peminjaman[0]->id_anggota;
                $t_denda->id_pinjam = $get_peminjaman[0]->id;
                $t_denda->denda = $request->input('denda');
                $t_denda->save();
            }

            t_peminjaman::find($get_peminjaman[0]->id)->delete();
            t_peminjaman_detail::where('id', $get_peminjaman[0]->id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil di tambahkan',
                'denda' => $t_denda->count(),
                'data' => $t_pengembalian
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal di hapus',
            ], 200);
        }
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
        }
        return response()->json([
            'success'   => true,
            'message'   => 'Data peminjaman',
            'data'      => $data,
        ], 200);
    }
    function get_pengembalian(Request $request)
    {
        if ($request->input('id_anggota') != "") {
            $get_peminjaman = t_peminjaman::leftJoin('m_kelas', 'm_kelas.id', '=', 't_peminjaman.id_kelas')
                ->leftJoin('m_anggota', 'm_anggota.id', '=', 't_peminjaman.id_anggota')
                ->select('t_peminjaman.*', 'm_kelas.nm_kelas', 'm_anggota.nm_lengkap')
                ->get();
            $list_pengembalian["peminjam"] = $get_peminjaman;
            $list_pengembalian["buku"] = t_peminjaman_detail::where('id', $get_peminjaman[0]['id'])->get();
            return response()->json([
                'success'   => true,
                'data'      => $list_pengembalian,
            ], 200);
        } else {
            $t_pengembalian = t_pengembalian::leftJoin('m_anggota', 'm_anggota.id', '=', 't_pengembalian.id_anggota')
            ->select('t_pengembalian.*', 'm_anggota.nm_lengkap','m_anggota.id_kelas')
            ->get();
            return response()->json([
                'success'   => true,
                'message'   => 'Data peminjaman',
                'data'      => $t_pengembalian,
            ], 200);
        }
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
