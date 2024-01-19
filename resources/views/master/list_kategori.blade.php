@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

    <div class="card">

        <div class="card-header card-title d-flex justify-content-between">
            <div class="">
                Data Kategori Buku
            </div>
            <x-btn-add />
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <x-table id="table-buku">
                    <thead>
                        <tr class="text-center">
                            <th>
                                Kode Kategori
                            </th>
                            <th>
                                Nama Kategori
                            </th>
                            <th>
                                #
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">KD001</td>
                            <td class="text-center">Pendidikan</td>
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
