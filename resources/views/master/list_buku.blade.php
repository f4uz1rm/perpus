<x-app-layout>

    <div class="card">

        {{-- <div class="card-header card-title d-flex justify-content-between">
            <div class="">
                Data Buku
            </div>
            <div class="d flex justify-self-stretch">
                <button class="btn btn-warning dropdown-toggle" type="button" id="dropdown-export"
                    data-bs-toggle="dropdown" aria-haspopup="true" onclick="" aria-expanded="false">
                    Ekspor ke
                </button>
                <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownMenuButton">
                    <li>
                        <a id="btn-excel-buku" class="dropdown-item border-radius-md" href="javascript:;">
                            <i class="fa fa-file-excel-o mx-2" aria-hidden="true"></i>Excel</a>
                    </li>
                    <li>
                        <a id="btn-pdf-buku" class="dropdown-item border-radius-md" href="javascript:;">
                            <i class="fa fa-file-pdf-o mx-2" aria-hidden="true"></i>PDF</a>
                    </li>

                </ul>
                <x-btn-add />
            </div>
        </div> --}}
        <div class="card-header card-title row">
            <div class="col-sm">
                Data Buku

            </div>
            <div class="col-sm d-flex justify-content-end">
                <button class="btn btn-warning dropdown-toggle mx-1" type="button" id="dropdown-export"
                    data-bs-toggle="dropdown" aria-haspopup="true" onclick="" aria-expanded="false">
                    Ekspor ke
                </button>
                <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownMenuButton">
                    <li>
                        <a id="btn-excel-buku" class="dropdown-item border-radius-md" href="javascript:;">
                            <i class="fa fa-file-excel-o mx-2" aria-hidden="true"></i>Excel</a>
                    </li>
                    <li>
                        <a id="btn-pdf-buku" class="dropdown-item border-radius-md" href="javascript:;">
                            <i class="fa fa-file-pdf-o mx-2" aria-hidden="true"></i>PDF</a>
                    </li>

                </ul>
                <x-btn-add class="mx-1" />
            </div>
        </div>
        <div class="card-body py-1">
            <div class="table-responsive">
                <x-table id="table-buku">
                    <thead>
                        <tr class="text-center">

                            <th>
                                Kode Buku
                            </th>
                            <th>
                                Judul
                            </th>
                            <th>
                                Semester
                            </th>
                            <th>
                                Tahun Buku
                            </th>
                            <th>
                                Penulis
                            </th>
                            <th>
                                Penerbit
                            </th>
                            <th>
                                Jumlah
                            </th>
                            <th>
                                Lokasi Rak
                            </th>
                            <th>
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tbody-buku">

                    </tbody>
                </x-table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-buku" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Tambah / Ubah Buku</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3" hidden>
                            <label for="is_metode" class="form-label">Is Metode</label>
                            <input type="search" class="form-control" id="is_metode" readonly
                                placeholder="Otomatis Terisi">
                        </div>
                        <div class="mb-3" hidden>
                            <label for="id_buku" class="form-label">ID Buku</label>
                            <input type="search" class="form-control" id="id_buku" readonly
                                placeholder="Otomatis Terisi">
                        </div>
                        <div class="mb-3">
                            <label for="kd_buku" class="form-label">Kode Buku</label>
                            <input type="search" class="form-control" id="kd_buku" readonly
                                placeholder="Otomatis Terisi">
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="id_kategori" class="form-label">Kategori</label>
                                    <select name="" id="id_kategori" class="form-control">
                                        <option value="" selected>Pilih Kategori</option>
                                    </select>
                                    <label for="" class="text-danger">
                                        * Jika Kategori belum ada, silahkan tambahkan kategori terlebih dahulu
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Buku</label>
                            <input type="search" class="form-control" id="judul" placeholder="Judul Buku">
                        </div>
                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select name="" id="semester" class="form-control">
                                <option value="" selected>Pilih Semester</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tahun" class="form-label">Tahun </label>
                            <input type="number" class="form-control" id="tahun" placeholder="Tahun">
                        </div>
                        <div class="mb-3">
                            <label for="pengarang" class="form-label">Penulis</label>
                            <input type="search" class="form-control" id="penulis" placeholder="Pengarang">
                        </div>
                        <div class="mb-3">
                            <label for="penerbit" class="form-label">Penerbit</label>
                            <input type="search" class="form-control" id="penerbit" placeholder="Penerbit">
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Jumlah Buku</label>
                            <input type="number" class="form-control" id="stok" placeholder="Jumlah Buku">
                        </div>
                        <div class="mb-3">
                            <label for="lokasi_rak" class="form-label">Lokasi RAK</label>
                            <select name="lokasi_rak" class="form-control" id="lokasi_rak">

                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" onclick="simpan_buku()">Simpan</button>
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
                    <button type="button" class="btn btn-success"
                        onclick="print_barcode($('#jml_print').val())">Print</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-import" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-print">Import Buku</h5>
                </div>
                <div class="modal-body">

                    <form class="">
                        <input type="file">
                    </form>



                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" onclick="import_buku()">Import </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#btn-add").on("click", function() {
            ubah_buku("");
        })

        get_buku()
        get_kategori()
        get_rak()

        function get_kategori() {
            $.ajax({
                type: "GET",
                url: "{{ route('get_kategori') }}",

                beforeSend: function() {
                    $("#id_kategori").html(`<option value="" selected>Loading...</option>`);

                },
                success: function(data) {
                    if (data.data.length > 0) {
                        let html = "";
                        html += `<option value="">Pilih Kategori</option>`;
                        data.data.forEach((item, index) => {
                            html += `<option value="${item.id}">${item.nm_kategori}</option>`;
                        });
                        $("#id_kategori").html(html);
                    } else {
                        $("#id_kategori").html(
                            `<option value="" selected>Tidak ada data yang ditampilkan</option>`);
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

        function get_rak() {
            $.ajax({
                type: "GET",
                url: "{{ route('get_rak') }}",

                beforeSend: function() {
                    $("#lokasi_rak").html(`<option value="" selected>Loading...</option>`);
                },
                success: function(data) {
                    if (data.data.length != "0") {
                        let html = "";
                        html += `<option value="">Pilih Lokasi Rak</option>`;
                        data.data.forEach((item, index) => {
                            html +=
                                `<option value="${item.id}">${item.lokasi_rak}-${item.nm_rak}</option>`;
                        });
                        $("#lokasi_rak").html(html)
                    } else {
                        $("#lokasi_rak").html(
                            `<option value="" selected>Tidak ada data yang ditampilkan</option>`);
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

        function get_buku() {
            $.ajax({
                type: "GET",
                url: "{{ route('get_buku') }}",

                beforeSend: function() {
                    $("#tbody-buku").html(`
                    <tr>
                        <td colspan="9" class="text-center">Loading...</td>
                    </tr>
                `);
                },
                success: function(data) {
                    if (data.data.length > 0) {
                        let html = "";
                        data.data.forEach((item, index) => {
                            html += `<tr>`;

                            html += `<td class="text-center">${item.kd_buku}</td>`;
                            html += `<td class="text-wrap">${item.judul}</td>`;
                            html += `<td class="text-center">${item.semester}</td>`;
                            html += `<td class="text-center">${item.tahun}</td>`;
                            html += `<td class="text-wrap">${item.penulis}</td>`;
                            html += `<td class="text-wrap">${item.penerbit}</td>`;
                            html += `<td class="text-center">${item.stok}</td>`;
                            html += `<td class="text-center">${item.lok_rak}</td>`;
                            html += `<td class="text-center">`;
                            html +=
                                `<button class="btn btn-sm btn-danger mx-1" onclick="hapus_buku(${item.id})">Hapus</button>`;
                            html +=
                                `<button class="btn btn-sm btn-success mx-1" onclick="ubah_buku(${item.id})" >Ubah</button>`;
                            html +=
                                `<button class="btn btn-sm btn-primary mx-1" onclick="print_buku('${item.kd_buku}')" >Print</button>`;
                            html += `</td>`;
                            html += `</tr>`;
                        });
                        $("#tbody-buku").html(html);
                        if ($("#table-buku").hasClass("dataTable")) {
                            $("#table-buku").DataTable().destroy();
                        }
                        $("#tbody-buku").html(html);
                        let nama_table = "BUKU";
                        let table_buku = $('table').DataTable({
                            responsive: true,
                            // rowReorder: {
                            //     selector: 'td:nth-child(2)'
                            // },
                            drawCallback: function() {
                                feather.replace();
                            },
                            buttons: [

                                //EXPORT EXCEL
                                {
                                    extend: 'excelHtml5',
                                    oriented: 'potrait',
                                    pageSize: 'A4',
                                    autoFilter: true,
                                    sheetName: 'Data_Buku',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6,7]

                                    },
                                    filename: "Export " + nama_table + " - {{ date('Y-m-d') }}",
                                    title: 'INFORMASI MASTER ' + nama_table +
                                        ' - MIFTAHUL ULUM',
                                    messageTop: 'Created Date : {{ date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s') }}',
                                    // messageBottom: "Bandung, <?= date('d-m-Y') ?> \r\n\r\r Bagian {{ session('outlet') }}",
                                    // messageBottom : function (x) { 
                                    //     var sheet = x.xl.worksheets['sheet1.xml'];
                                    //     $('row c[r^="A2"]', sheet).attr('s', '52');
                                    //     $('[r] t', sheet).text('Created Date : {{ date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s') }}');
                                    //  },
                                    // customize: function(xlsx) {
                                    //     var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                    //     $('[r=A2] t', sheet).text(
                                    //         'Created Date : {{ date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s') }}'
                                    //         );
                                    //     $('row c[r^="A1"]', sheet).attr('s',
                                    //     '50'); //https://datatables.net/reference/button/excelHtml5
                                    //     $('row c[r^="A2"]', sheet).attr('s', '50');
                                    //     $('row:last c', sheet).attr('s', '52');

                                    // },
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
                                        columns: [0, 1, 2, 3, 4, 5, 6,7]

                                    },
                                    customize: function(doc) {
                                        doc.content.unshift([{
                                                text: 'INFORMASI DATA MASTER BUKU',
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

                        $("#btn-excel-buku").on("click", function() {
                            table_buku.button('.buttons-excel').trigger();
                        });

                        $("#btn-pdf-buku").on("click", function() {
                            table_buku.button('.buttons-pdf').trigger();
                        });
                    } else {
                        $("#tbody-buku").html(`
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada data yang ditampilkan</td>
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

        function ubah_buku(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('get_buku') }}",
                data: {
                    id_buku: id
                },

                beforeSend: function() {
                    Swal.fire({
                        title: 'Loading...',
                        text: "Sedang memuat data",
                        showConfirmButton: false,
                    })
                },
                success: function(data) {
                    console.log(data)
                    Swal.close()
                    let value = data.data;
                    if (id == "") {
                        $("#is_metode").val("tambah");
                        $("#modal-title").html("Tambah Buku");
                        $("#id_buku").val("").trigger("change");
                        $("#kd_buku").val("").trigger("change");
                        $("#nm_buku").val("").trigger("change");
                        $("#semester").val("").trigger("change");
                        $("#penulis").val("").trigger("change");
                        $("#penerbit").val("").trigger("change");
                        $("#stok").val("").trigger("change");
                        $("#tahun").val("").trigger("change");
                        $("#lokasi_rak").val("").trigger("change");
                        $("#id_kategori").val("").trigger("change");
                        $("#judul").val("").trigger("change");
                    } else {
                        $("#is_metode").val("ubah");
                        $("#modal-title").html("Ubah Buku");
                        $("#id_buku").val(value.id).trigger("change");
                        $("#kd_buku").val(value.kd_buku).trigger("change");
                        $("#semester").val(value.semester).trigger("change");
                        $("#judul").val(value.judul).trigger("change");
                        $("#penulis").val(value.penulis).trigger("change");
                        $("#penerbit").val(value.penerbit).trigger("change");
                        $("#stok").val(value.stok).trigger("change");
                        $("#tahun").val(value.tahun).trigger("change");
                        $("#lokasi_rak").val(value.lokasi_rak).trigger("change");
                        $("#id_kategori").val(value.id_kategori).trigger("change");
                    }
                    $("#modal-buku").modal("show");

                }
            }).fail(function(err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Gagal memuat data, silahkan refresh halaman"
                })
            })
        }

        function simpan_buku() {
            let is_metode = $("#is_metode").val();
            let id_buku = $("#id_buku").val();
            let kd_buku = $("#kd_buku").val();
            let judul = $("#judul").val();
            let penulis = $("#penulis").val();
            let penerbit = $("#penerbit").val();
            let tahun = $("#tahun").val();
            let stok = $("#stok").val();
            let id_kategori = $("#id_kategori").val();
            let lokasi_rak = $("#lokasi_rak").val();
            let semester = $("#semester").val();

            if (semester == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Semester tidak boleh kosong"
                })
                $("#semester").addClass("is-invalid");
            }else if (id_kategori == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Kategori tidak boleh kosong"
                })
                $("#nm_kategori").addClass("is-invalid");
            } else if (judul == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Judul tidak boleh kosong"
                })
                $("#judul").addClass("is-invalid");
            } else if (stok == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Stok tidak boleh kosong"
                })
                $("#stok").addClass("is-invalid");
            } else if (lokasi_rak == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Lokasi Rak tidak boleh kosong"
                })
                $("#lokasi_rak").addClass("is-invalid");
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
                            url: is_metode == "tambah" ? "{{ route('add_buku') }}" :
                                "{{ route('update_buku') }}",
                            data: {
                                _token: "{{ csrf_token() }}",
                                id_buku: id_buku,
                                kd_buku: kd_buku,
                                judul: judul,
                                penulis: penulis,
                                penerbit: penerbit,
                                tahun: tahun,
                                stok: stok,
                                id_kategori: id_kategori,
                                semester: semester,
                                lokasi_rak: lokasi_rak,
                            },

                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Loading...',
                                    text: "Sedang memuat data",
                                    showConfirmButton: false,
                                })
                            },
                            success: function(data) {
                                console.log(data)
                                Swal.close()
                                if (data.success == true) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: data.message,
                                        timer: 1500,
                                        showConfirmButton: false,
                                        outsideClick: false
                                    }).then((result) => {
                                        $("#modal-buku").modal("hide");
                                        get_buku();
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: data.message
                                    })
                                }
                            }
                        }).fail(function(err) {
                            console.log(err)
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

        function hapus_buku(id) {
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
                        url: "{{ route('delete_kategori') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_buku: id,
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
                                        $("#modal-kategori").modal("hide");
                                        get_buku();
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


        function print_buku(kd_buku) {
            console.log(kd_buku)

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
            console.log(jml_print)
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
