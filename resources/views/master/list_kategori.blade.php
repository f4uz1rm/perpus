<x-app-layout>

    <div class="card">

        <div class="card-header card-title d-flex justify-content-between">
            <div class="">
                Data Kategori
            </div>
            <x-btn-add />
        </div>
        <div class="card-body py-2">
            <div class="table-responsive">
                <x-table id="table-kategori">
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
                    <tbody id="tbody-kategori">

                    </tbody>
                </x-table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-kategori" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Tambah / Ubah Kategori</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="is_metode" class="form-label">Is Metode</label>
                            <input type="search" class="form-control" id="is_metode" readonly
                                placeholder="Otomatis Terisi">
                        </div>
                        <div class="mb-3">
                            <label for="id_kategori" class="form-label">Kode Kategori</label>
                            <input type="search" class="form-control" id="id_kategori" readonly
                                placeholder="Otomatis Terisi">
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="nm_kategori" class="form-label">Nama Kategori</label>
                                    <input type="search" id="nm_kategori" class="form-control"
                                        placeholder="Nama Kelas">
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" onclick="simpan_kategori()">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#btn-add").on("click", function() {
            ubah_kategori("");
        })

        $("#nm_kategori").on("keypress", function() {
            if (event.keyCode === 13) {
                simpan_kategori();
            }
        })
        get_kategori()

        function get_kategori() {
            $.ajax({
                type: "GET",
                url: "{{ route('get_kategori') }}",

                beforeSend: function() {
                    $("#tbody-kategori").html(`
                    <tr>
                        <td colspan="3" class="text-center">Loading...</td>
                    </tr>
                `);
                },
                success: function(data) {
                    if (data.data.length > 0) {
                        let html = "";
                        data.data.forEach((item, index) => {
                            html += `<tr>`;
                            html += `<td class="text-center">${item.id}</td>`;
                            html += `<td class="text-center">${item.nm_kategori}</td>`;
                            html += `<td class="text-center">`;
                            html +=
                                `<button class="btn btn-sm btn-danger mx-1" onclick="hapus_kategori(${item.id})">Hapus</button>`;
                            html +=
                                `<button class="btn btn-sm btn-success mx-1" onclick="ubah_kategori(${item.id})" >Ubah</button>`;
                            html += `</td>`;
                            html += `</tr>`;
                        });
                        $("#tbody-kategori").html(html);
                        if ($("#table-kategori").hasClass("dataTable")) {
                            $("#table-kategori").DataTable().destroy();
                        }
                        $("#tbody-kategori").html(html);
                        $('table').DataTable();
                    } else {
                        $("#tbody-kategori").html(`
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada data yang ditampilkan</td>
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

        function ubah_kategori(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('get_kategori') }}",
                data: {
                    id_kategori: id
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
                        $("#modal-title").html("Tambah Kategori");
                        $("#id_kategori").val("").trigger("change");
                        $("#nm_kategori").val("").trigger("change");
                    } else {
                        $("#is_metode").val("ubah");
                        $("#modal-title").html("Ubah Kategori");
                        $("#id_kategori").val(value.id).trigger("change");
                        $("#nm_kategori").val(value.nm_kategori).trigger("change");
                    }
                    $("#modal-kategori").modal("show");

                }
            }).fail(function(err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Gagal memuat data, silahkan refresh halaman"
                })
            })
        }

        function simpan_kategori() {
            let is_metode = $("#is_metode").val();
            let id_kategori = $("#id_kategori").val();
            let nm_kategori = $("#nm_kategori").val();
            if (nm_kategori == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Nama Kategori tidak boleh kosong"
                })
                $("#nm_kategori").addClass("is-invalid");
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
                            url: is_metode == "tambah" ? "{{ route('add_kategori') }}" :
                                "{{ route('update_kategori') }}",
                            data: {
                                _token: "{{ csrf_token() }}",
                                id_kategori: id_kategori,
                                nm_kategori: nm_kategori
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
                                        timer: 1500,
                                        showConfirmButton: false,
                                        outsideClick: false
                                    }).then((result) => {
                                        $("#modal-kategori").modal("hide");
                                        get_kategori();
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

        function hapus_kategori(id) {
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
                            id_kategori: id,
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
                                        get_kategori();
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
