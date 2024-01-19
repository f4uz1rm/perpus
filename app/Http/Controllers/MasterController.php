<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterController extends Controller
{
    function list_buku()
    {
        return view('master.list_buku');
    }
    function list_anggota()
    {
        return view('master.list_anggota');
    }
    function list_pengunjung()
    {
        return view('master.list_pengunjung');
    }
    function list_kategori()
    {
        return view('master.list_kategori');
    }
}
