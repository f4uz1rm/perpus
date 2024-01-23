<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

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
    function list_pengunjung(): View
    {
        return view('master.list_pengunjung');
    }
    function view_pengunjung(): View
    {
        return view('master.view_pengunjung');
    }
    function list_kategori(): View
    {
        return view('master.list_kategori');
    }
    function list_kelas(): View
    {
        return view('master.list_kelas');
    }
}
