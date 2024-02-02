<x-app-layout>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <div class="row">
        <div class="col-md mt-1">
            <div class="card">
                <div class="card-body">
                    <div id="full-calender"></div>
                </div>
            </div>
        </div>
        <div class="col-md mt-1">
            <div class="card">
                <div class="card-header card-title d-flex justify-content-between">
                    Jadwal Kunjungan
                    <div class="">
                        <a href="#" class="btn btn-success btn-sm" onclick="ubah_jadwalkunjungan('')">
                            <i class="icon-sm" data-feather="plus"></i>
                            Tambah Data</a>
                    </div>
                </div>
                <div class="card-body py-2">
                    <x-table id="table-jadwalkunjungan">
                        <thead class="text-center">
                            <tr>
                                <th>Tanggal Kunjungan</th>
                                <th>Kelas</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-jadwalkunjungan">
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data</td>
                            </tr>
                        </tbody>
                    </x-table>
                </div>
            </div>
        </div>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-jadwalkunjungan" tabindex="-1" aria-labelledby="modal-jadwalkunjungan"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-jadwalkunjunganLabel">Form Jadwal Kunjungan</h5>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="id_kunjungan" class="col-sm-3 col-form-label">ID Kunjungan</label>
                        <div class="col-sm-9">
                            <input type="text" name="" id="id_kunjungan" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tgl_kunjungan" class="col-sm-3 col-form-label">Tanggal Kunjungan</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="tgl_kunjungan">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="id_kelas" class="col-sm-3 col-form-label">Kelas</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="id_kelas">

                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="id_kelas" class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <input type="text" name="" id="keterangan" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" onclick="simpan_jadwalkunjungan()">Simpan
                        Data</button>
                </div>
            </div>
        </div>
    </div>



    <script>
        //  document.addEventListener('DOMContentLoaded', function() {
        //     var calendarEl = document.getElementById('full-calender');
        //     var calendar = new FullCalendar.Calendar(calendarEl, {
        //         initialView: 'dayGridMonth',
        //         locale: 'id',
        //     });
        //     calendar.render();
        // });

        get_jadwalkunjungan();
        get_kelas();
        $("#tgl_kunjungan").val("{{ date('Y-m-d') }}");

        function get_jadwalkunjungan() {
            $.ajax({
                metode: "GET",
                url: "{{ route('get_jadwalkunjungan') }}",

                beforeSend: function() {
                    $("#tbody-jadwalkunjungan").html(`
                    <tr>
                        <td colspan="5" class="text-center">Loading...</td>
                    </tr>
                `);
                },
                success: function(data) {
                    if (data.data.length == "0") {
                        $("#tbody-jadwalkunjungan").html(`
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data yang ditampilkan</td>
                        </tr>
                    `);

                        var calendarEl = document.getElementById('full-calender');
                        calendar = new FullCalendar.Calendar(calendarEl, {
                            initialView: 'dayGridMonth',
                            locale: 'id',
                        });

                        calendar.render();


                    } else {
                        let calendar;
                        let event = [];
                        let html = "";
                        data.data.forEach((item, index) => {
                            html += `<tr>`;
                            html +=
                                `<td class="text-center">${moment(item.tgl_kunjungan,"YYYY-MM-DD").format("DD-MM-YYYY")}</td>`;
                            html += `<td class="text-center">${item.nm_kelas}</td>`;
                            html += `<td class="text-wrap">${item.keterangan}</td>`;
                            html += `<td class="text-center">`;
                            html +=
                                `<button class="btn btn-sm btn-danger mx-1" onclick="hapus_jadwalkunjungan(${item.id})">Hapus</button>`;
                            html +=
                                `<button class="btn btn-sm btn-success mx-1" onclick="ubah_jadwalkunjungan(${item.id})" >Ubah</button>`;
                            html += `</td>`;
                            html += `</tr>`;

                            event.push({
                                title: "Kelas : " + item.nm_kelas,
                                start: item.tgl_kunjungan,
                                end: item.tgl_kunjungan,

                            });

                        });
                        var calendarEl = document.getElementById('full-calender');
                        calendar = new FullCalendar.Calendar(calendarEl, {
                            initialView: 'dayGridMonth',
                            locale: 'id',
                        });
                        calendar.addEventSource(event);

                        calendar.render();

                        $("#tbody-jadwalkunjungan").html(html);
                        if ($("#table-jadwalkunjungan").hasClass("dataTable")) {
                            $("#table-jadwalkunjungan").DataTable().destroy();
                        }
                        let nama_table = "JADWAL KUNJUNGAN";
                        let table_pengunjung = $('#table-jadwalkunjungan').DataTable({
                            responsive: true,
                            buttons: [
                                //EXPORT EXCEL
                                {
                                    extend: 'excelHtml5',
                                    oriented: 'potrait',
                                    pageSize: 'A4',
                                    autoFilter: true,
                                    sheetName: 'Data_JadwalKunjungan',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3]

                                    },
                                    filename: "Export " + nama_table + " - {{ date('Y-m-d') }}",
                                    title: 'INFORMASI MASTER ' + nama_table +
                                        ' - MIFTAHUL ULUM',
                                    messageTop: 'Created Date : {{ date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s') }}',
                                },
                                //EXPORT PDF
                                {
                                    extend: 'pdf',
                                    oriented: 'potrait',
                                    pageSize: 'A4',
                                    title: '',
                                    download: 'download',
                                    filename: "Export " + nama_table + " - {{ date('Y-m-d') }}",
                                    exportOptions: {
                                        columns: [0, 1, 2, 3]

                                    },
                                    customize: function(doc) {
                                        doc.content.unshift([{
                                                text: 'INFORMASI DATA MASTER JADWAL KUNJUNGAN',
                                                style: 'font-size: 15px;'
                                            },

                                            {
                                                text: "Created Date : {{ date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s') }}",
                                                margin: [0, 0, 0, 10]
                                            },

                                        ]);

                                    }

                                },
                            ],
                        });
                        $("#btn-excel-jadwal-kunjungan").on("click", function() {
                            table_jadwalkunjungan.button('.buttons-excel').trigger();
                        });

                        $("#btn-pdf-jadwal-kunjungan").on("click", function() {
                            table_jadwalkunjungan.button('.buttons-pdf').trigger();
                        });

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

        function get_kelas() {
            $.ajax({
                type: "GET",
                url: "{{ route('get_kelas') }}",

                beforeSend: function() {
                    $("#tbody-kelas").html(`
                    <tr>
                        <td colspan="4" class="text-center">Loading...</td>
                    </tr>
                `);
                },
                success: function(data) {
                    if (data.data.length > 0) {
                        let html = "";
                        html += `<option value="" selected>Pilih Kelas</option>`;
                        data.data.forEach((item, index) => {
                            html += `<option value="${item.id}">${item.nm_kelas}</option>`;
                        });
                        $("#id_kelas").html(html);
                    } else {
                        $("#id_kelas").html(`<option value="" selected>Pilih Kelas</option>`);
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

        function ubah_jadwalkunjungan(id) {
            $.ajax({
                url: "{{ route('get_jadwalkunjungan') }}",
                type: "GET",
                data: {
                    id_kunjungan: id
                },
                beforeSend: function() {
                    $("#tgl_kunjungan").val("{{ date('Y-m-d') }}");
                    $("#id_kelas").val("");
                    $("#keterangan").val("");
                    Swal.fire({
                        title: 'Loading...',
                        allowOutsideClick: false,
                        html: 'Mohon tunggu sebentar',
                        didOpen: () => {
                            Swal.showLoading()
                        },
                    })
                },
                success: function(data) {
                    Swal.close();
                    if (id == "") {
                        $("#modal-jadwalkunjungan").modal("show");
                        $("#modal-jadwalkunjunganLabel").html("Tambah Data Jadwal Kunjungan");
                        $("#id_kelas").val("");
                        $("#keterangan").val("");
                    } else {
                        $("#modal-jadwalkunjungan").modal("show");
                        $("#modal-jadwalkunjunganLabel").html("Ubah Data Jadwal Kunjungan");
                        $("#id_kunjungan").val(data.data[0].id);
                        $("#tgl_kunjungan").val(data.data[0].tgl_kunjungan);
                        $("#id_kelas").val(data.data[0].id_kelas);
                        $("#keterangan").val(data.data[0].keterangan);


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


        function simpan_jadwalkunjungan() {
            let tgl_kunjungan = $("#tgl_kunjungan").val();
            let id_kelas = $("#id_kelas").val();
            let keterangan = $("#keterangan").val();
            let id_kunjungan = $("#id_kunjungan").val();

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data akan disimpan ke database",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan Data!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: id_kunjungan == "" ? "POST" : "PUT",
                        url: id_kunjungan == "" ? "{{ route('add_jadwalkunjungan') }}" :
                            "{{ route('update_jadwalkunjungan') }}",
                        beforeSend: function() {
                            Swal.fire({
                                allowOutsideClick: false,

                                title: 'Loading...',
                                html: 'Mohon tunggu sebentar',
                                didOpen: () => {
                                    Swal.showLoading()
                                },
                            })
                        },
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_kunjungan: id_kunjungan,
                            tgl_kunjungan: tgl_kunjungan,
                            id_kelas: id_kelas,
                            keterangan: keterangan,
                            nm_petugas: "{{ Auth::user()->name }}"
                        },
                        success: function(data) {
                            Swal.close();
                            if (data.success == true) {
                                Swal.fire(
                                    'Berhasil!',
                                    data.message,
                                    'success'
                                );
                                $("#modal-jadwalkunjungan").modal("hide");
                                get_jadwalkunjungan();
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    data.message,
                                    'error'
                                );
                            }
                        }
                    }).fail(function(err) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: "Gagal menyimpan data, silahkan coba lagi"
                        })
                    })
                }
            })
        }

        function hapus_jadwalkunjungan(id_kunjungan) {

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data akan dihapus dari database",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus Data!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('delete_jadwalkunjungan') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_kunjungan: id_kunjungan,

                        },
                        beforeSend: function() {
                            Swal.fire({
                                allowOutsideClick: false,
                                title: 'Loading...',
                                html: 'Mohon tunggu sebentar',
                                didOpen: () => {
                                    Swal.showLoading()
                                },
                            })
                        },
                        success: function(data) {
                            Swal.close();
                            if (data.success == true) {
                                Swal.fire(
                                    'Berhasil!',
                                    data.message,
                                    'success'
                                );
                                get_jadwalkunjungan();
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    data.message,
                                    'error'
                                );
                            }
                        }
                    }).fail(function(err) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: "Gagal menghapus data, silahkan coba lagi"
                        })
                    })
                }
            })

        }
    </script>
</x-app-layout>
