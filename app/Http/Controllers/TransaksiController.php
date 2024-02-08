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

        // return $request->all();
        try {
            $response = $client->post(
                config('app.url') . '/perpus/api/add_peminjaman',
                [
                    'json' => $request->all(),
                ]
            );
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            // Tangani kesalahan timeout atau kesalahan lainnya
            return [
                "message" => $e->getMessage(),  
                'status' => 'error',
                'error' => 'Koneksi terputus atau kesalahan lainnya'
            ];
        }
    }

    function get_peminjaman(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->get(
                config('app.url') . '/perpus/api/get_peminjaman',
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

    function get_jadwalkunjungan(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->get(
                config('app.url') . '/perpus/api/get_jadwalkunjungan',
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
    function add_jadwalkunjungan(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->post(
                config('app.url') . '/perpus/api/add_jadwalkunjungan',
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
    function update_jadwalkunjungan(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->put(
                config('app.url') . '/perpus/api/update_jadwalkunjungan',
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
    function delete_jadwalkunjungan(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->delete(
                config('app.url') . '/perpus/api/delete_jadwalkunjungan',
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
