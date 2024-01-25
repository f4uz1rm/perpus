<x-app-layout>

    <div class="card">

        <div class="card-header card-title d-flex justify-content-between">
            <div class="">
                Data Buku
            </div>
            <x-btn-add />
            {{-- <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target=".btn-add">
                <i class="icon-sm mr-2" data-feather="plus"></i> Tambah Data
            </button> --}}
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
                                Tahun Buku
                            </th>
                            <th>
                                Jumlah
                            </th>
                            <th>
                                Penulis
                            </th>
                            <th>
                                Penerbit
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
                        <div class="mb-3">
                            <label for="kd_buku" class="form-label">Kode Buku</label>
                            <input type="search" class="form-control" id="kd_buku" readonly
                                placeholder="Otomatis Terisi">
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="ketegori" class="form-label">Kategori</label>
                                    <select name="" id="kategori" class="form-control">
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
                            <label for="tahun" class="form-label">Tahun </label>
                            <input type="search" class="form-control" id="tahun" placeholder="Tahun">
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
                            <label for="jml_buku" class="form-label">Jumlah Buku</label>
                            <input type="search" class="form-control" id="jumlah" placeholder="Jumlah Buku">
                        </div>
                        <div class="mb-3">
                            <label for="lokasi_rak" class="form-label">Lokasi RAK</label>
                            <select name="lokasi_rak" class="form-control" id="lokasi_rak">
                                <option value="" selected>Pilih Lokasi Rak</option>
                                <option value="1">Rak Matematika</option>
                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        $("#btn-add").on("click", function() {
            ubah_buku("");
        })

        get_buku()

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
                            html += `<td class="text-center">${item.judul}</td>`;
                            html += `<td class="text-center">${item.tahun}</td>`;
                            html += `<td class="text-center">${item.stok}</td>`;
                            html += `<td class="text-center">${item.penulis}</td>`;
                            html += `<td class="text-center">${item.penerbit}</td>`;
                            html += `<td class="text-center">${item.lok_rak}</td>`;
                            html += `<td class="text-center">`;
                            html +=
                                `<button class="btn btn-sm btn-danger mx-1" onclick="hapus_kategori(${item.id})">Hapus</button>`;
                            html +=
                                `<button class="btn btn-sm btn-success mx-1" onclick="ubah_buku(${item.id})" >Ubah</button>`;
                            html += `</td>`;
                            html += `</tr>`;
                        });
                        $("#tbody-buku").html(html);
                        if ($("#table-buku").hasClass("dataTable")) {
                            $("#table-buku").DataTable().destroy();
                        }
                        $("#tbody-buku").html(html);
                        $('table').DataTable();
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
                        $("#modal-title").html("Tambah Buku");
                        $("#id_buku").val("").trigger("change");
                        $("#nm_buku").val("").trigger("change");
                    } else {
                        $("#is_metode").val("ubah");
                        $("#modal-title").html("Ubah Buku");
                        $("#id_buku").val(value.id).trigger("change");
                        $("#kd_buku").val(value.kd_buku).trigger("change");
                        $("#judul").val(value.judul).trigger("change");
                        $("#tahun").val(value.tahun).trigger("change");
                        $("#tahun").val(value.tahun).trigger("change");
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
            let id_kategori = $("#id_buku").val();
            let nm_kategori = $("#nm_buku").val();
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
    </script>

</x-app-layout>
