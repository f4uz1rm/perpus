<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class TransaksiController extends Controller
{
    function list_peminjaman()
    {
        return view('transaksi.list_peminjaman');
    }
    function form_peminjaman()
    {
        return view('transaksi.form_peminjaman');
    }
    function list_pengembalian()
    {
        return view('transaksi.list_pengembalian');
    }
    function form_pengembalian()
    {
        return view('transaksi.form_pengembalian');
    }
    function list_jadwalkunjungan()
    {
        return view('transaksi.list_jadwalkunjungan');
    }

    function simpan_peminjaman(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->delete(
                config('app.url') . '/perpus/api/add_peminjaman',
                [
                    'json' => $request->all(),
                ]
            );
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            // Tangani kesalahan timeout atau kesalahan lainnya
            return [
                'status' => 'error',
                'error' => 'Koneksi terputus atau kesalahan lainnya'
            ];
        }
    }
}
