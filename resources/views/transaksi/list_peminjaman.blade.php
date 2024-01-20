<x-app-layout>


    <div class="card">

        <div class="card-header card-title d-flex justify-content-between">
            <div class="">
                Data Peminjaman Buku
            </div>
            <a href="{{ route('form_peminjaman') }}" class="btn btn-success btn-sm">
                <i class="icon-sm" data-feather="plus"></i>
                Tambah Data</a>
        </div>
        <div class="card-body py-0">
            <div class="table-responsive">
                <x-table id="table-peminjaman">
                    <thead>
                        <tr class="text-center">
                            <th>
                                Kode Pinjam
                            </th>
                            <th>
                                Nama Peminjam
                            </th>
                            <th>
                                Tanggal Pinjam
                            </th>
                            <th>
                                Tanggal Kembali
                            </th>
                            <th>
                                Jumlah Pinjam
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
                            <td class="text-center">25 Juni 2024</td>
                            <td class="text-center">26 Juni 2024</td>
                            <td class="text-center">4</td>
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

</x-app-layout>
