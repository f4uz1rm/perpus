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
                         
                        </tr>
                    </thead>
                    <tbody id="tbody-peminjaman">
                     
                    </tbody>
                </x-table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('table').DataTable({
                responsive: true
            });
            get_peminjaman()
        })
    </script>

    <script>
        function get_peminjaman() {
            $.ajax({
                type: "GET",
                url: "{{ route('get_peminjaman') }}",

                beforeSend: function() {
                    $("#tbody-peminjaman").html(`
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


                            if (item.tgl_kembali >= moment().format("YYYY-MM-DD")) {
                                html += `<tr class="text-center">`;
                            } else {
                                html += `<tr class="text-center table-danger">`;
                            }

                            // html += `<td class="text-center">${item.id}</td>`;
                            html += `<td class="text-center">${item.id}</td>`;
                            html += `<td class="text-center">${item.nm_lengkap}</td>`;
                            html += `<td class="text-center">${moment(item.tgl_pinjam,"YYYY-MM-DD").format("DD-MM-YYYY")}</td>`;
                            html += `<td class="text-center">${moment(item.tgl_kembali,"YYYY-MM-DD").format("DD-MM-YYYY")}</td>`;
                          
                            html += `</tr>`;
                        });
                        $("#tbody-peminjaman").html(html);
                        if ($("#table-peminjaman").hasClass("dataTable")) {
                            $("#table-peminjaman").DataTable().destroy();
                        }
                        $("#tbody-peminjaman").html(html);
                        $('table').DataTable({
                            responsive: true,
                            drawCallback: function(settings, json) {
                                feather.replace();
                            }
                        });
                    } else {
                        $("#tbody-peminjaman").html(`
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

        function ubah_peminjaman(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('get_rak') }}",
                data: {
                    id_rak: id
                },

                beforeSend: function() {
                    Swal.fire({
                        title: 'Loading...',
                        text: "Sedang memuat data",
                        showConfirmButton: false,
                    })
                },
                success: function(data) {
                    Swal.close()
                    let value = data.data;
                    if (id == "") {
                        $("#is_metode").val("tambah");
                        $("#modal-rak").modal("show");
                        $("#modal-title").html("Tambah Kelas");
                        $("#id_rak").val("").trigger("change");
                        $("#nm_rak").val("").trigger("change");
                        $("#kode_rak").val("").trigger("change");
                        $("#lokasi_rak").val("").trigger("change");
                    } else {
                        $("#is_metode").val("ubah");
                        $("#modal-rak").modal("show");
                        $("#modal-title").html("Ubah Kelas");
                        $("#id_rak").val(value.id).trigger("change");
                        $("#kode_rak").val(value.kd_rak).trigger("change");
                        $("#lokasi_rak").val(value.lokasi_rak).trigger("change");
                        $("#nm_rak").val(value.nm_rak).trigger("change");
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

    </script>

</x-app-layout>
