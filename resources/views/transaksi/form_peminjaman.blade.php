<x-app-layout>
    <div class="card mb-2">
        <div class="card-header card-title">Tambah Peminjaman Buku</div>
        <div class="card-body py-1">
            <div class="h6 mb-2">Detail Peminjam</div>
            <div class="row ">
                <div class="col-sm-10">

                    <div class="row mb-3">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama Peminjam</label>
                        <div class="col-sm">
                            <div class="input-group">

                                <select name="" id="" class="form-control">
                                    <option value="">Pilih Anggota</option>
                                </select>
                                <span class="input-group-text">
                                    <label for="" class="my-auto">KODE</label>
                                </span>
                            </div>

                            <div class="text-danger">
                                *Jika nama anggota tidak di temukan harap isi telebih dahulu di halaman <a
                                    href="{{ route('list_anggota') }}">Data Anggota</a>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Tanggal Pinjam</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="DD-MM-YYYY">
                                <span class="input-group-text">
                                    <i class="icon-sm" data-feather="calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Tanggal Kembali</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="DD-MM-YYYY">
                                <span class="input-group-text">
                                    <i class="icon-sm" data-feather="calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Keterangan Lain</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Keterangan Lain">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <hr>
            <div class="mb-3">
                <label for="kd_buku" class="form-label">Kode Buku</label>
                <div class="input-group">
                    <input type="search" class="form-control" id="kd_buku" placeholder="Masukan Kode Buku">
                    <span class="input-group-text">
                        <i class="icon-sm" data-feather="search"></i>
                    </span>
                </div>
            </div>
            <div class=" mb-2 d-flex justify-content-between">
                <label for="" class="h6">
                    Detail Buku
                </label>


            </div>
            <div class="" id="list_buku">
                {{-- @for ($i = 0; $i < 1; $i++)
                    <div class="row ">
                        <div class="col-sm-8">
                            <div class="row mb-3">
                                <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Judul Buku</label>
                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">Kode Buku</span>
                                        <input type="text" class="form-control" id="exampleInputUsername2"
                                            placeholder="Judul Buku" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="input-group">
                                <input type="number" class="form-control" value="1">
                                <span class="input-group-text ">
                                    <i class="icon-sm mr-2 text-danger" data-feather="trash"></i>
                                    Hapus
                                </span>
                            </div>
                        </div>
                    </div>
                @endfor --}}
            </div>


        </div>

        <div class="card-footer d-flex justify-content-between">
            <a class="btn btn-sm btn-danger" type="button" href="{{ route('list_peminjaman') }}">Batal</a>
            <button class="btn btn-sm btn-success" onclick="simpan_peminjaman()">
                <i class="icon-sm" data-feather="save"></i>
                Simpan Data</button>
        </div>
    </div>
</x-app-layout>


<script>
    $("#kd_buku").on("change", function() {
        get_buku_bykode(this.value)
    })

    function get_buku_bykode(kd_buku) {
        $.ajax({
            type: "GET",
            url: "{{ route('get_buku_bykode') }}",
            data: {
                kd_buku: kd_buku
            },
            beforeSend: function() {
                Swal.fire({
                    title: 'Loading',
                    html: 'Mohon Tunggu Sebentar',
                    didOpen: () => {
                        Swal.showLoading()
                    },
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                })
            },

            success: function(data) {
                Swal.close();
                let item = data.data;
                let list_buku = $("#list_buku");

                if (item == null) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "Buku Tidak Ditemukan",
                        showConfirmButton: false,
                        timer: 1000
                    })
                    $("#kd_buku").focus();
                    $("#kd_buku").val("");
                } else {

                    // Cek apakah buku dengan kd_buku yang sama sudah ada dalam daftar
                    let existingBook = list_buku.find(`[data-kd-buku="${item.kd_buku}"]`);



                    if (existingBook.length > 0) {
                        // Jika sudah ada, tambahkan jumlahnya
                        let existingQuantity = existingBook.find(".quantity");
                        let newQuantity = parseInt(existingQuantity.val()) + 1;
                        existingQuantity.val(newQuantity);
                    } else {
                        // Jika belum ada, tambahkan elemen baru
                        let html = `
                        <div class="row list_buku_pinjam" data-kd-buku="${item.kd_buku}">
                        <div class="col-sm-8">
                            <div class="row mb-3">
                            <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Judul Buku</label>
                            <div class="col-sm">
                                <div class="input-group">
                                <span class="input-group-text" id="kd_buku">${item.kd_buku}</span>
                                <input type="text" class="form-control" id="judul_buku" value="${item.judul}" placeholder="Judul Buku" readonly>
                                </div>
                                
                            </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="input-group">
                            <input type="number" class="form-control quantity" value="1">
                            <span class="input-group-text delete-book" data-kd-buku="${item.kd_buku}">
                                <i class="icon-sm mr-2 text-danger" data-feather="trash"></i> Hapus
                            </span>
                            </div>
                        </div>
                        </div>
                    `;
                        list_buku.append(html);

                        // Tambahkan event listener untuk tombol hapus
                        list_buku.find(`[data-kd-buku="${item.kd_buku}"] .delete-book`).on("click",
                            function() {
                                $(this).closest(".row").remove();
                            });
                        feather.replace()
                    }
                    $("#kd_buku").focus();
                    $("#kd_buku").val("");

                }



            }
        }).fail(function(err) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Terjadi Kesalahan",
            })
        })


    }

    function simpan_peminjaman() {
        let list_buku = $("#list_buku");
        let bukuArray = [];

        let kd_anggota = $("#kd_anggota").val();
        let tgl_pinjam = $("#tgl_pinjam").val();
        let tgl_kembali = $("#tgl_kembali").val();
        let keterangan = $("#keterangan").val();
        let kd_transaksi = $("#kd_transaksi").val();

        list_buku.find(".list_buku_pinjam").each(function() {
            let kdBuku = $(this).data("kd-buku");
            let jumlahBuku = $(this).find(".quantity").val();

            bukuArray.push({
                kd_buku: kdBuku,
                jumlah: jumlahBuku,
            });
        });
        Swal.fire({
            title: 'Simpan Data',
            text: "Apakah anda yakin ingin menyimpan data ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan Data!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    data: {
                        kd_transaksi: kd_transaksi,
                        kd_anggota: kd_anggota,
                        tgl_pinjam: tgl_pinjam,
                        tgl_kembali: tgl_kembali,
                        keterangan: keterangan,
                        buku: bukuArray
                    },
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Loading',
                            html: 'Mohon Tunggu Sebentar',
                            didOpen: () => {
                                Swal.showLoading()
                            },
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                        })
                    },

                    success: function(data) {
                        Swal.close();
                        if (data.status == "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1000
                            }).then((result) => {
                                window.location.href = "{{ route('list_peminjaman') }}";
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
                        text: "Terjadi Kesalahan",
                    })
                })
            }
        })

    }
</script>
