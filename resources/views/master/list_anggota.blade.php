@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

    <div class="card">

        <div class="card-header card-title d-flex justify-content-between">
            <div class="">
                Data Anggota
            </div>
            <x-btn-add />
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <x-table id="table-buku">
                    <thead>
                        <tr class="text-center">
                            <th>
                                Kode Anggota
                            </th>
                            <th>
                                Nama Lengkap
                            </th>
                            <th>
                                Jenis Kelamin
                            </th>
                            <th>
                                Kelas
                            </th>
                            <th>
                                Masa Aktif Anggota
                            </th>
                            <th>
                              #
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">KT001</td>
                            <td class="text-wrap">Fauzi Rizky Mauladani</td>
                            <td class="text-center">Laki - Laku</td>
                            <td class="text-center">7A</td>
                            <td class="text-center">12 Januari 2024</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-danger" id="btn-delete">Hapus</button>
                                <button class="btn btn-sm btn-success" id="btn-edit">Ubah</button>
                            </td>
                        </tr>
                    </tbody>
                </x-table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('table').DataTable();
        })
    </script>

@endsection
