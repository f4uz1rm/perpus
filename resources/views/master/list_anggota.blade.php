<x-app-layout>
    <div class="card">

        <div class="card-header card-title d-flex justify-content-between">
            <div class="">
                Data Anggota
            </div>
            <x-btn-add />
        </div>
        <div class="card-body py-0">
            <div class="table-responsive">
                <x-table id="table-anggota">
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
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tbody-anggota">

                    </tbody>
                </x-table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-anggota" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Tambah / Ubah Anggota</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3" hidden>
                            <label for="is_metode" class="form-label">Is Metode</label>
                            <input type="search" class="form-control" id="is_metode" readonly
                                placeholder="Otomatis Terisi">
                        </div>
                        <div class="mb-3">
                            <label for="id_anggota" class="form-label">Kode Anggota</label>
                            <input type="search" class="form-control" id="id_anggota" readonly
                                placeholder="Otomatis Terisi">
                        </div>
                        <div class="mb-3">
                            <label for="nm_anggota" class="form-label">Status</label>
                            <select class="form-control" id="">
                                <option value="siswa">Siswa / Siswi</option>
                                <option value="guru">Guru</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nisn" class="form-label">NISN ( Nomer Induk Siswa Nasional )</label>
                            <input type="search" class="form-control" id="nisn"
                                placeholder="Masukan NISN Jika tersedia">
                        </div>
                        <div class="mb-3">
                            <label for="nm_lengkap" class="form-label">Nama Anggota</label>
                            <input type="search" class="form-control" id="nm_lengkap" placeholder="Nama Anggota">
                        </div>
                        <div class="mb-3">
                            <label for="jns_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" id="jns_kelamin">
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select class="form-control" id="kelas">
                                <option value="" selected>Pilih Kelas</option>
                            </select>
                        </div>
                        
                    </form>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" onclick="simpan_anggota()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
   
    <div class="modal fade" id="modal-print" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-print">Print Anggota</h5>
                </div>
                <div class="modal-body">
                    <div class="">
                        <div class="d-flex justify-content-center">
                                <div id="kartu-anggota"></div>
                        </div>
                    </div>

                    <div id="print-preview-container" style="display: none;"></div>


                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success"
                        onclick="print_kartu()">Download Kartu</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <script>
        $(document).ready(function() {
            get_kelas();
            get_anggota()

        })
        $(".datepicker").datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
            todayHighlight: true,
        });

        $("#btn-add").click(function() {
            ubah_anggota("");
        })



        function get_anggota() {
            $.ajax({
                metode: "GET",
                url: "{{ route('get_anggota') }}",
                beforeSend: function() {
                    $("#tbody-anggota").html(`
                    <tr>
                        <td colspan="8" class="text-center">Loading...</td>
                    </tr>
                `);
                },
                success: function(data) {
                    console.log(data)
                    if (data.data.length != 0) {
                        let html = "";
                        data.data.forEach((item, index) => {
                            html += `<tr>`;
                            html += `<td class="text-center">${item.id}</td>`;
                            html += `<td class="text-wrap">${item.nm_lengkap}</td>`;
                            html +=
                                `<td class="text-center">${(item.jns_kelamin=="L"?"Laki-Laki":"Perempuan")}</td>`;
                            html += `<td class="text-center">${item.nm_kelas}</td>`;
                            html +=
                                `<td class="text-center">${moment(item.masa_aktif,'YYYY-MM-DD').format("DD-MM-YYYY")}</td>`;
                            html += `<td class='text-center'>`;

                            html +=
                                `<button class="btn btn-sm btn-danger mx-1" onclick="hapus_anggota('${item.id}')">Hapus</button>`;
                            html +=
                                `<button class="btn btn-sm btn-success mx-1" onclick="ubah_anggota('${item.id}')" >Ubah</button>`;
                            html +=
                                `<button class="btn btn-sm btn-primary mx-1" onclick="print_anggota('${item.id}','${item.nm_lengkap}','${item.nm_kelas}','${item.masa_aktif}')" >Print</button>`;
                            html += `</td>`;
                            html += `</tr>`;
                        });
                        $("#tbody-anggota").html(html);
                        if ($("#table-anggota").hasClass("dataTable")) {
                            $("#table-anggota").DataTable().destroy();
                        }
                        $("#tbody-anggota").html(html);
                        $('table').DataTable({
                            responsive: true,
                        });
                    } else {
                        $("#tbody-anggota").html(`
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data yang ditampilkan</td>
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
    </script>

    <script>
        function ubah_anggota(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('get_anggota') }}",
                data: {
                    id_anggota: id
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

                    console.log(data)
                    let value = data.data;
                    if (id == "") {
                        $("#is_metode").val("tambah");
                        $("#modal-title").html("Tambah Anggota");
                        $("#status").val("").trigger("change");
                        $("#nisn").val("").trigger("change");
                        $("#nm_lengkap").val("").trigger("change");
                        $("#jns_kelamin").val("L").trigger("change");
                        $("#kelas").val("").trigger("change");
                        $("#masa_aktif").val("").trigger("change");
                    } else {
                        $("#is_metode").val("ubah");
                        $("#modal-title").html("Ubah Anggota");
                        $("#id_anggota").val(value.id).trigger("change");
                        $("#status").val(value.status).trigger("change");
                        $("#nisn").val(value.nisn).trigger("change");
                        $("#nm_lengkap").val(value.nm_lengkap).trigger("change");
                        $("#jns_kelamin").val(value.jns_kelamin).trigger("change");
                        $("#kelas").val(value.id_kelas).trigger("change");
                        $("#masa_aktif").val(moment(value.masa_aktif, 'YYYY-MM-DD').format("DD-MM-YYYY"))
                            .trigger("change");
                        // $("#masa_aktif").datepicker("setDate",moment(value.masa_aktif,'YYYY-MM-DD').format("DD-MM-YYYY"));
                    }
                    $("#modal-anggota").modal("show");

                }
            }).fail(function(err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Gagal memuat data, silahkan refresh halaman"
                })
            })
        }

        function simpan_anggota() {
            let is_metode = $("#is_metode").val();
            let id_anggota = $("#id_anggota").val();
            let status = $("#status").val()
            let nisn = $("#nisn").val()
            let nm_lengkap = $("#nm_lengkap").val()
            let jns_kelamin = $("#jns_kelamin").val()
            let kelas = $("#kelas").val()

            if (masa_aktif == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Masa Aktif tidak boleh kosong"
                })
                $("#masa_aktif").addClass("is-invalid");
            }else if (kelas == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Kelas tidak boleh kosong"
                })
                $("#kelas").addClass("is-invalid");
            }else if (jns_kelamin == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Jenis Kelamin tidak boleh kosong"
                })
                $("#jns_kelamin").addClass("is-invalid");
            } else if (status == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Status tidak boleh kosong"
                })
                $("#status").addClass("is-invalid");
            } else if (nm_lengkap == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Nama Lengkap tidak boleh kosong"
                })
                $("#nm_lengkap").addClass("is-invalid");
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
                            url: is_metode == "tambah" ? "{{ route('add_anggota') }}" :
                                "{{ route('update_anggota') }}",
                            data: {
                                _token: "{{ csrf_token() }}",
                                "id_anggota": id_anggota,
                                "nm_lengkap": nm_lengkap,
                                "jns_kelamin": jns_kelamin,
                                "status": status,
                                "nisn": nisn,
                                "id_kelas": kelas,
                                "masa_aktif": moment(masa_aktif, 'DD-MM-YYYY').format("YYYY-MM-DD"),
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
                                        $("#modal-anggota").modal("hide");
                                        get_anggota();
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

        function hapus_anggota(id) {
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
                        url: "{{ route('delete_anggota') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_anggota: id,
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
                                        $("#modal-anggota").modal("hide");
                                        get_anggota();
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


        function print_anggota(id_anggota,nm_lengkap,kelas,masa_aktif) {
            var cardHTML = `
            <div class="card border" id="card-anggota">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-evenly">  <img src="{{ asset('assets/images/logo-ponpes.png')}}" width="50px"><div class="my-auto mx-auto">Kartu Anggota Perpus</div></div>
                    <hr>
                    <div class="card-text ">Nama Lengkap:<br><div class="h6"> ${nm_lengkap}</div></div>
                    <div class="card-text">Kelas: ${kelas}</div>
                    <div class="card-text">Kode Anggota: ${id_anggota}</div>
                    <svg id="barcode"></svg>
                    <div class="card-text text-center">Masa Aktif: ${moment(masa_aktif,"YYYY-MM-DD").format("DD-MM-YYYY")}</div>
                </div>
            </div>
        `;
        $("#kartu-anggota").html(cardHTML);

        JsBarcode("#barcode", id_anggota, {
            format: "CODE128",
            displayValue: false
        });

        // Set the HTML content to the member card container
        $("#modal-print").modal("show")

        
        }

        // Function to print multiple copies
       
        function print_kartu() {
            var cardContent = $("#kartu-anggota").clone();

            // Create a new window to contain only the cloned content
            var printWindow = window.open('','_BLANK');
            printWindow.document.write('<html><head><title>Print</title>');
            printWindow.document.write('<link rel="stylesheet" type="text/css" href="{{asset('assets/css/demo1/style.css')}}">');


            // Include your external CSS file in the new window
            printWindow.document.write('</head><body>');
            printWindow.document.write('<div class="border">');
            printWindow.document.write(cardContent[0].outerHTML);
            printWindow.document.write('</div>');

            // Append the cloned content to the new window
            printWindow.document.write('</body></html>');

            // Close the document to ensure it's ready for printing
            printWindow.document.close();

            // Trigger the print dialog
            printWindow.print();

            // Close the new window after printing
            printWindow.close();
        }

    </script>

    <script>
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
                        $("#kelas").html(html);
                    } else {
                        $("#kelas").html(`<option value="" selected>Pilih Kelas</option>`);
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
