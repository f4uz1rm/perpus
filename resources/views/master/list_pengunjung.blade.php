<x-app-layout>

    <div class="card">

        <div class="card-header card-title d-flex justify-content-between">
            <div class="">
                Data Pengunjung
            </div>
            <x-btn-add />
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <x-table id="table-buku">
                    <thead>
                        <tr class="text-center">
                            <th>
                                Tanggal Kunjungan
                            </th>
                            <th>
                                Nama Lengkap
                            </th>
                            <th>
                                Kelas
                            </th>
                            <th>
                                Tujuan Ke Pespustakaan
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">25 Januari 2024 10:00</td>
                            <td class="text-wrap">Fauzi Rizky Mauladani</td>
                            <td class="text-center">7A</td>
                            <td class="">Membaca Buku</td>
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
