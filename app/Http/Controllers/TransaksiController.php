<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
