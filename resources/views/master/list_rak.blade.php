<x-app-layout>

    <div class="card">

        <div class="card-header card-title d-flex justify-content-between">
            <div class="">
                Data Rak
            </div>
            <x-btn-add />
        </div>
        <div class="card-body py-0">
            <div class="table-responsive">
                <x-table id="table-rak">
                    <thead>
                        <tr class="text-center">
                            <th>
                                Print
                            </th>
                      
                            <th>
                                Nama Rak
                            </th>
                            <th>
                                Lokasi Rak
                            </th>
                            <th>
                                #
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tbody-rak">

                    </tbody>
                </x-table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-rak" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="varyingModalLabel">Tambah / Ubah Rak</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="is_metode" class="form-label">Is Metode</label>
                            <input type="search" class="form-control" id="is_metode" readonly
                                placeholder="Otomatis Terisi">
                        </div>
                        <div class="mb-3">
                            <label for="id_rak" class="form-label">ID Rak</label>
                            <input type="search" class="form-control" id="id_rak" readonly
                                placeholder="Otomatis Terisi">
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="nm_rak" class="form-label">Nama Rak</label>
                                    <input type="text" id="nm_rak" class="form-control" placeholder="Nama Rak">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="lokasi_rak" class="form-label">Lokasi Rak</label>
                                    <input type="text" id="lokasi_rak" class="form-control" placeholder="Lokasi Rak">
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" onclick="simpan_rak()">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-print" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-print">Print Buku</h5>
                </div>
                <div class="modal-body">
                    <div class="">
                        <div class="d-flex justify-content-center">
                            <svg id="barcode"></svg>
                        </div>
                        <hr>
                        <label for="barcode" class="form-label">Jumlah Print</label>
                        <input type="number" class="form-control" id="jml_print" placeholder="Jumlah Print"
                            value="1">

                    </div>
                    

                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" onclick="print_barcode($('#jml_print').val())">Print</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#btn-add").on("click", function() {
            ubah_rak("");
        })

        $("#nm_rak").on("keypress", function() {
            if (event.keyCode === 13) {
                simpan_rak();
            }
        })
        get_rak()

        function get_rak() {
            $.ajax({
                type: "GET",
                url: "{{ route('get_rak') }}",

                beforeSend: function() {
                    $("#tbody-rak").html(`
                    <tr>
                        <td colspan="4" class="text-center">Loading...</td>
                    </tr>
                `);
                },
                success: function(data) {
                    if (data.data.length > 0) {
                        let html = "";
                        data.data.forEach((item, index) => {
                            html += `<tr>`;
                            html += `<td class="text-center">`;
                            html +=
                                `<button class="btn btn-sm btn-primary mx-1" onclick="print_rak('${item.lokasi_rak}')" ><i class="icon-sm" data-feather="printer"></i>
                                    </button>`;
                            html += `</td>`;
                            // html += `<td class="text-center">${item.id}</td>`;
                            html += `<td class="text-center">${item.nm_rak}</td>`;
                            html += `<td class="text-center">${item.lokasi_rak}</td>`;
                            html += `<td class="text-center">`;
                            html +=
                                `<button class="btn btn-sm btn-danger mx-1" onclick="hapus_rak(${item.id})">Hapus</button>`;
                            html +=
                                `<button class="btn btn-sm btn-success mx-1" onclick="ubah_rak(${item.id})" >Ubah</button>`;

                            html += `</td>`;
                            html += `</td>`;
                        });
                        $("#tbody-rak").html(html);
                        if ($("#table-rak").hasClass("dataTable")) {
                            $("#table-rak").DataTable().destroy();
                        }
                        $("#tbody-rak").html(html);
                        $('table').DataTable({
                            drawCallback: function(settings, json) {
                                feather.replace();
                            }
                        });
                    } else {
                        $("#tbody-rak").html(`
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data yang ditampilkan</td>
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

        function ubah_rak(id) {
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

        function simpan_rak() {
            let is_metode = $("#is_metode").val();
            let id_rak = $("#id_rak").val();
            let nm_rak = $("#nm_rak").val();
            let lokasi_rak = $("#lokasi_rak").val();
            if (nm_rak == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Nama Rak tidak boleh kosong"
                })
                $("#nm_rak").addClass("is-invalid");
            } if (lokasi_rak == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Lokasi Rak tidak boleh kosong"
                })
                $("#nm_rak").addClass("is-invalid");
            } else {


                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: is_metode == "tambah" ? "Data akan ditambahkan" : "Data akan diubah",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Lanjutkan!',
                    cancelButtonText: 'Tidak, Batalkan!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: is_metode == "tambah" ? "POST" : "PUT",
                            url: is_metode == "tambah" ? "{{ route('add_rak') }}" :
                                "{{ route('update_rak') }}",
                            data: {
                                _token: "{{ csrf_token() }}",
                                id_rak: id_rak,
                                nm_rak: nm_rak,
                                lokasi_rak: lokasi_rak
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
                                if (data.success == true) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: data.message,
                                        timer: 1000,
                                        showConfirmButton: false,
                                        outsideClick: false
                                    }).then((result) => {
                                        $("#modal-rak").modal("hide");
                                        get_rak();
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: data.message,
                                    })
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
                })
            }
        }

        function hapus_rak(id_rak) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data akan dihapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Lanjutkan!',
                cancelButtonText: 'Tidak, Batalkan!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('delete_rak') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_rak: id_rak,
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
                            if (data.success == true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: data.message,
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $("#modal-rak").modal("hide");
                                        get_rak();
                                    }
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: "Gagal menyimpan data, silahkan coba lagi",
                                })
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
            })
        }

        
        function print_rak(kd_buku) {

            JsBarcode("#barcode", kd_buku, {
                format: "CODE128",
                displayValue: true,
                fontSize: 14,
                width: 1,
                height: 50
            });

            $("#modal-print").modal("show")
        }

        // Function to print multiple copies
        function print_barcode(jml_print) {
            if (!jml_print) {
                // Default to one copy if not specified
                jml_print = 1;
            }

            var printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Print</title></head><body>');
            printWindow.document.write('<div style="text-align: left; width:100%">');
            for (var i = 0; i < jml_print; i++) {
                printWindow.document.write(document.getElementById("barcode").outerHTML);
            }
            printWindow.document.write('</div></body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
</x-app-layout>
