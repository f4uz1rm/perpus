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
    function list_rak(): View
    {
        return view('master.list_rak');
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

    function get_pengunjung(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->get(
                config('app.url') . '/perpus/api/get_pengunjung',
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
    function get_kelas(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->get(
                config('app.url') . '/perpus/api/get_kelas',
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
    function add_kelas(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->post(
                config('app.url') . '/perpus/api/add_kelas',
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
    function update_kelas(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->put(
                config('app.url') . '/perpus/api/update_kelas',
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
    function delete_kelas(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->delete(
                config('app.url') . '/perpus/api/delete_kelas',
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


    function get_kategori(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->get(
                config('app.url') . '/perpus/api/get_kategori',
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
    function add_kategori(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->post(
                config('app.url') . '/perpus/api/add_kategori',
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
    function update_kategori(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->put(
                config('app.url') . '/perpus/api/update_kategori',
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
    function delete_kategori(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->delete(
                config('app.url') . '/perpus/api/delete_kategori',
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



    function get_anggota(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->get(
                config('app.url') . '/perpus/api/get_anggota',
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


    function get_buku(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->get(
                config('app.url') . '/perpus/api/get_buku',
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
    function get_buku_bykode(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->get(
                config('app.url') . '/perpus/api/get_buku_bykode',
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

    function add_buku(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->post(
                config('app.url') . '/perpus/api/add_buku',
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
    function update_buku(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->put(
                config('app.url') . '/perpus/api/update_buku',
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
    function delete_buku(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->delete(
                config('app.url') . '/perpus/api/delete_buku',
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
    function get_rak(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->get(
                config('app.url') . '/perpus/api/get_rak',
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
    function add_rak(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->post(
                config('app.url') . '/perpus/api/add_rak',
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
    function update_rak(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->put(
                config('app.url') . '/perpus/api/update_rak',
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
    function delete_rak(Request $request)
    {
        $client = new Client(['timeout' => 10]); // Mengatur timeout menjadi 10 detik
        try {
            $response = $client->delete(
                config('app.url') . '/perpus/api/delete_rak',
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

    function view_pengunjung(): View
    {
        return view('master.view_pengunjung');
    }
}
