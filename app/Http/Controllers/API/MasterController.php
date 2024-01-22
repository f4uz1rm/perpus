<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    function get_pengunjung(Request $request)
    {
        $data = \App\Models\m_pengunjung::all();
        return response()->json([
            'success' => true,
            'message' => 'List Kunjungan',
            'data' => $data
        ], 200);
    }

    function get_kelas(Request $request)
    {
        $data = \App\Models\m_kelas::all();
        return response()->json([
            'success' => true,
            'message' => 'List Kelas',
            'data' => $data
        ], 200);
    }
}
