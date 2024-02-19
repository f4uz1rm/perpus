<x-app-layout>


    <div class="card">

        <div class="card-header card-title d-flex justify-content-between">
            <div class="">
                Data Pengambalian
            </div>
            <a href="{{ route('form_pengembalian') }}" class="btn btn-success btn-sm">
                <i class="icon-sm" data-feather="plus"></i>
                Tambah Data</a>
        </div>
        <div class="card-body pt-0">
            <div class="table-responsive">
                <x-table id="table-pengembalian">
                    <thead>
                        <tr class="text-center">
                            <th>
                                Kode Pinjam
                            </th>
                            <th>
                                Nama Peminjam
                            </th>
                            <th>
                                Tanggal Kembali
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tbody-pengembalian">

                    </tbody>
                </x-table>
            </div>
        </div>
    </div>

    <script>
        function get_pengembalian() {
            $.ajax({
                type: "GET",
                url: "{{ route('get_pengembalian') }}",
                data : {
                    is_metode : "daftar"
                },

                beforeSend: function() {
                    $("#tbody-pengembalian").html(`
                <tr>
                    <td colspan="5" class="text-center">Loading...</td>
                </tr>
            `);
                },
                success: function(data) {
                    console.log(data)
                    if (data.data.length > 0) {
                        let html = "";
                        data.data.forEach((item, index) => {
                            html += `<tr class="text-center">`;
                            html += `<td class="text-center">${item.id}</td>`;
                            html += `<td class="text-center">${item.nm_lengkap}</td>`;
                            html +=
                                `<td class="text-center">${moment(item.tgl_kembali,"YYYY-MM-DD").format("DD-MM-YYYY")}</td>`;

                            html += `</tr>`;
                        });
                        $("#tbody-pengembalian").html(html);
                        if ($("#table-pengembalian").hasClass("dataTable")) {
                            $("#table-pengembalian").DataTable().destroy();
                        }
                        $("#tbody-pengembalian").html(html);
                        $('table').DataTable({
                            responsive: true,
                            drawCallback: function(settings, json) {
                                feather.replace();
                            }
                        });
                    } else {
                        $("#tbody-pengembalian").html(`
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data yang ditampilkan</td>
                    </tr>
                `);
                    }


                }
            }).fail(function(err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Gagal memuat data, silahkan refresh halaman"
                })
            })
        }


        get_pengembalian()

    </script>

</x-app-layout>
