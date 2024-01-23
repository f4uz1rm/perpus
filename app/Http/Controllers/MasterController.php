<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class MasterController extends Controller
{
    function list_buku(): View
    {
        return view('master.list_buku');
    }
    function list_anggota(): View
    {
        return view('master.list_anggota');
    }
    function list_kategori(): View
    {
        return view('master.list_kategori');
    }
    function list_kelas(): View
    {
        return view('master.list_kelas');
    }


    function tambah_pengunjung(Request $request)
    {

        // return $request->all();

        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->post(
                config('app.url') . '/perpus/api/add_pengunjung',
                [
                    'json' => $request->all(),
                ]
            );
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            // Tangani kesalahan timeout atau kesalahan lainnya
            return [
                'status' => 'error',
                'error' => 'Koneksi terputus atau kesalahan lainnya',
                'message' => $e->getMessage(),
            ];
        }
    }


    function list_pengunjung(): View
    {
        return view('master.list_pengunjung');
    }
    function view_pengunjung(): View
    {
        return view('master.view_pengunjung');
    }
}
