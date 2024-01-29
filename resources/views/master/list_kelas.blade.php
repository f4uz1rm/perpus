<x-app-layout>

    <div class="card">

        <div class="card-header card-title d-flex justify-content-between">
            <div class="">
                Data Kelas
            </div>
            <x-btn-add />
        </div>
        <div class="card-body py-2">
            <div class="table-responsive">
                <x-table id="table-kelas">
                    <thead>
                        <tr class="text-center">
                            <th>
                                Kode Kelas
                            </th>
                            <th>
                                Nama Kelas
                            </th>
                            <th>
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tbody-kelas">

                    </tbody>
                </x-table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-kelas" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Tambah / Ubah Kelas</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3" hidden>
                            <label for="is_metode" class="form-label">Is Metode</label>
                            <input type="search" class="form-control" id="is_metode" readonly
                                placeholder="Otomatis Terisi">
                        </div>
                        <div class="mb-3">
                            <label for="id_kelas" class="form-label">Kode Kelas</label>
                            <input type="search" class="form-control" id="id_kelas" readonly
                                placeholder="Otomatis Terisi">
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="nm_kelas" class="form-label">Nama Kelas</label>
                                    <input type="search" id="nm_kelas" class="form-control" placeholder="Nama Kelas">
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" onclick="simpan_kelas()">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#btn-add").on("click", function() {
            ubah_kelas("");
        })

        $("#nm_kelas").on("keypress", function() {
           if (event.keyCode === 13) {
                simpan_kelas();
           }
        })
        get_kelas()
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
                        data.data.forEach((item, index) => {
                            html += `<tr>`;
                            html += `<td class="text-center">${item.id}</td>`;
                            html += `<td class="text-center">${item.nm_kelas}</td>`;
                            html += `<td class="text-center">`;
                            html +=
                                `<button class="btn btn-sm btn-danger mx-1" onclick="hapus_kelas(${item.id})">Hapus</button>`;
                            html +=
                                `<button class="btn btn-sm btn-success mx-1" onclick="ubah_kelas(${item.id})" >Ubah</button>`;
                            html += `</td>`;
                            html += `</tr>`;
                        });
                        $("#tbody-kelas").html(html);
                        if ($("#table-kelas").hasClass("dataTable")) {
                            $("#table-kelas").DataTable().destroy();
                        }
                        $("#tbody-kelas").html(html);
                        $('table').DataTable({
                            responsive: true,
                        });
                    } else {
                        $("#tbody-kelas").html(`
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

        function ubah_kelas(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('get_kelas') }}",
                data: {
                    id_kelas: id
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
                    if (id =="") {
                        $("#is_metode").val("tambah");
                        $("#modal-kelas").modal("show");
                        $("#modal-title").html("Tambah Kelas");
                        $("#id_kelas").val("").trigger("change");
                        $("#nm_kelas").val("").trigger("change");
                    } else {
                        $("#is_metode").val("ubah");
                        $("#modal-kelas").modal("show");
                        $("#modal-title").html("Ubah Kelas");
                        $("#id_kelas").val(value.id).trigger("change");
                        $("#nm_kelas").val(value.nm_kelas).trigger("change");
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

        function simpan_kelas() {
            let is_metode = $("#is_metode").val();
            let id_kelas = $("#id_kelas").val();
            let nm_kelas = $("#nm_kelas").val();
            if (nm_kelas == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Nama Kelas tidak boleh kosong"
                })
                $("#nm_kelas").addClass("is-invalid");
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
                                url: is_metode == "tambah" ? "{{ route('add_kelas') }}" :
                                    "{{ route('update_kelas') }}",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    id_kelas: id_kelas,
                                    nm_kelas: nm_kelas
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
                                    if (data.success == true) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Berhasil',
                                            text: data.message,
                                            timer: 1000,
                                            showConfirmButton: false,
                                            outsideClick: false
                                        }).then((result) => {
                                            $("#modal-kelas").modal("hide");
                                                get_kelas();
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

        function hapus_kelas(id_kelas){
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
                                url: "{{ route('delete_kelas') }}",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    id_kelas: id_kelas,
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
                                                $("#modal-kelas").modal("hide");
                                                get_kelas();
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
    </script>
</x-app-layout>
