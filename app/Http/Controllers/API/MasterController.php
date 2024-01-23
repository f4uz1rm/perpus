<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\m_pengunjung;
use App\Models\m_anggota;
use App\Models\m_kelas;
use App\Models\m_kategori;
use App\Models\m_buku;
use App\Models\m_rak;

class MasterController extends Controller
{
    function get_pengunjung(Request $request)
    {
        $data =  m_pengunjung::all();
        return response()->json([
            'success' => true,
            'message' => 'Berhasil di tampilkan',
            'data' => $data
        ], 200);
    }
    function add_pengunjung(Request $request)
    {
        $data = new m_pengunjung();
        $data->nm_lengkap           = $request->input('nm_lengkap');
        $data->tujuan               = $request->input('tujuan');
        $data->tgl_kunjungan        = $request->input('tgl_kunjungan');
        $data->id_kelas             = $request->input('id_kelas');
        $data->save();
        return response()->json([
            'success' => true,
            'message' => 'Berhasil di tambahkan',
            'data' => $data
        ], 200);
    }

    function get_anggota(Request $request)
    {

        $id_anggota = $request->input('id_anggota');

        if ($id_anggota) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil di tampilkan',
                'data' => m_anggota::where('id', $id_anggota)->first()
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil di tampilkan',
                'data' => m_anggota::all()
            ], 200);
        }
    }

    function add_anggota(Request $request)
    {

        $data = new m_anggota();
        $get_nmlengkap = m_anggota::select("nm_lengkap")->where("nm_lengkap", $request->input('nm_lengkap'))->first();

        if ($get_nmlengkap) {
            return response()->json([
                'success' => false,
                'message' => 'Nama sudah tersedia / silahkan gunakan yang lain',
            ], 200);
        } else {
            $last_id = m_anggota::select('id')->max('id');
            $id_group   = substr($last_id, 5);
            $id_group  =  (int)$id_group + 1;
            $data->id           = "PPMU-" . sprintf("%03d", $id_group);
            $data->nm_lengkap           = $request->input('nm_lengkap');
            $data->jns_kelamin          = $request->input('jns_kelamin');
            $data->id_kelas             = $request->input('id_kelas');
            $data->status               = $request->input('status');
            $data->save();
            return response()->json([
                'success' => true,
                'message' => 'Berhasil di tambahkan',
                'data' => $data
            ], 200);
        }
    }

    function update_anggota(Request $request)
    {
        $data = m_anggota::find($request->input('id_anggota'))->first();
        if ($data) {
            $data->nm_lengkap           = $request->input('nm_lengkap');
            $data->jns_kelamin          = $request->input('jns_kelamin');
            $data->id_kelas             = $request->input('id_kelas');
            $data->status               = $request->input('status');
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
    function delete_anggota(Request $request)
    {
        $data = m_anggota::find($request->input('id_anggota'));

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

    function get_kelas(Request $request)
    {
        $id_kelas = $request->input('id_kelas');

        if ($id_kelas) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil di tampilkan',
                'data' => m_kelas::where('id', $id_kelas)->first()
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil di tampilkan',
                'data' => m_kelas::all()
            ], 200);
        }
    }

    function add_kelas(Request $request)
    {

        $data = new m_kelas();
        $get_kelas = m_kelas::select("nm_kelas")->where("nm_kelas", $request->input('nm_kelas'))->first();

        if ($get_kelas) {
            return response()->json([
                'success' => false,
                'message' => 'Nama sudah tersedia / silahkan gunakan yang lain',
            ], 200);
        } else {
            $data->nm_kelas               = $request->input('nm_kelas');
            $data->save();
            return response()->json([
                'success' => true,
                'message' => 'Berhasil di tambahkan',
                'data' => $data
            ], 200);
        }
    }

    function update_kelas(Request $request)
    {
        $data = m_kelas::find($request->input('id_kelas'))->first();
        if ($data) {
            $data->nm_kelas           = $request->input('nm_kelas');
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
    function delete_kelas(Request $request)
    {
        $data = m_kelas::find($request->input('id_kelas'));

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

    function get_kategori(Request $request)
    {
        $id_kategori = $request->input('id_kategori');

        if ($id_kategori) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil di tampilkan',
                'data' => m_kategori::where('id', $id_kategori)->first()
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil di tampilkan',
                'data' => m_kategori::all()
            ], 200);
        }
    }

    function add_kategori(Request $request)
    {
        $data = new m_kategori();
        $get_kelas = m_kategori::select("nm_kategori")->where("nm_kategori", $request->input('nm_kategori'))->first();

        if ($get_kelas) {
            return response()->json([
                'success' => false,
                'message' => 'Nama sudah tersedia / silahkan gunakan yang lain',
            ], 200);
        } else {
            $data->nm_kategori               = $request->input('nm_kategori');
            $data->save();
            return response()->json([
                'success' => true,
                'message' => 'Berhasil di tambahkan',
                'data' => $data
            ], 200);
        }
    }

    function update_kategori(Request $request)
    {
        $data = m_kategori::find($request->input('id_kategori'))->first();
        if ($data) {
            $data->nm_kategori  = $request->input('nm_kategori');
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

    function delete_kategori(Request $request)
    {
        $data = m_kategori::find($request->input('id_kategori'));

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

    function get_buku(Request $request)
    {
        $id_buku = $request->input('id_buku');

        if ($id_buku) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil di tampilkan',
                'data' => m_buku::where('id', $id_buku)->first()
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil di tampilkan',
                'data' => m_buku::all()
            ], 200);
        }
    }
    function add_buku(Request $request)
    {
        $data = new m_buku();
        $get_buku = m_buku::select("judul")->where("judul", $request->input('judul'))->first();

        if ($get_buku) {
            return response()->json([
                'success' => false,
                'message' => 'Nama sudah tersedia / silahkan gunakan yang lain',
            ], 200);
        } else {
            $last_id = m_buku::select('kd_buku')->max('kd_buku');
            $kd_buku   = substr($last_id, 5);
            $kd_buku  =  (int)$kd_buku + 1;
            $data->kd_buku               = "BKPP-" . sprintf("%03d", $kd_buku);
            $data->judul                     = $request->input('judul');
            $data->penulis                   = $request->input('penulis');
            $data->penerbit                  = $request->input('penerbit');
            $data->tahun                     = $request->input('tahun');
            $data->stok                      = $request->input('stok');
            $data->id_kategori               = $request->input('id_kategori');
            $data->save();
            return response()->json([
                'success' => true,
                'message' => 'Berhasil di tambahkan',
                'data' => $data
            ], 200);
        }
    }
    function update_buku(Request $request)
    {
        $data = m_buku::find($request->input('id_buku'))->first();
        if ($data) {
            $data->judul                     = $request->input('judul');
            $data->penulis                   = $request->input('penulis');
            $data->penerbit                  = $request->input('penerbit');
            $data->tahun                     = $request->input('tahun');
            $data->stok                      = $request->input('stok');
            $data->id_kategori                      = $request->input('id_kategori');
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

    function delete_buku(Request $request)
    {
        $data = m_buku::find($request->input('id_buku'));

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

    function get_rak(Request $request)
    {
        $id_rak = $request->input('id_rak');

        if ($id_rak) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil di tampilkan',
                'data' => m_rak::where('id', $id_rak)->first()
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil di tampilkan',
                'data' => m_rak::all()
            ], 200);
        }
    }
    function add_rak(Request $request)
    {
        $data = new m_rak();
        $get_buku = m_rak::select("nm_rak")->where("nm_rak", $request->input('nm_rak'))->first();

        if ($get_buku) {
            return response()->json([
                'success' => false,
                'message' => 'Nama sudah tersedia / silahkan gunakan yang lain',
            ], 200);
        } else {

            $data->nm_rak                   = $request->input('nm_rak');
            $data->lokasi_rak               = $request->input('lokasi_rak');
            $data->timestamps              = false;
            $data->save();
            return response()->json([
                'success' => true,
                'message' => 'Berhasil di tambahkan',
                'data' => $data
            ], 200);
        }
    }
    function update_rak(Request $request)
    {
        $data = m_rak::find($request->input('id_rak'))->first();
        if ($data) {
            $data->nm_rak                     = $request->input('nm_rak');
            $data->lokasi_rak               = $request->input('lokasi_rak');
            $data->timestamps              = false;
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

    function delete_rak(Request $request)
    {
        $data = m_rak::find($request->input('id_rak'));

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
