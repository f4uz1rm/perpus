<x-app-layout>
    <div class="card mb-2">
        <div class="card-header card-title">Pengembalian Buku</div>
        <div class="card-body py-1">
            <div class="h6 mb-2">Detail Peminjam</div>
            <div class="row ">
                <div class="col-sm-10">
                    <div class="row mb-3">
                        <label for="id_anggota" class="col-sm-3 col-form-label">Kode Anggota</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <input type="text" class="form-control" id="id_anggota" placeholder="Kode Anggota">
                                <span class="input-group-text" id="btn-search">
                                    <i class="icon-sm" data-feather="search"></i>
                                </span>
                                <span class="input-group-text">
                                    <i class="icon-sm" data-feather="camera" id="btn-camera"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nm_peminjam" class="col-sm-3 col-form-label">Nama Peminjam</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <input type="text" class="form-control" id="nm_peminjam" placeholder="Nama Anggota"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kelas" class="col-sm-3 col-form-label">Kelas</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <input type="text" class="form-control" id="nm_kelas" placeholder="Kelas" readonly>
                                <span class="input-group-text" id="id_kelas">

                                </span>
                            </div>

                        </div>
                    </div>
              
                </div>

            </div>
            <hr>


            <div class=" mb-4 d-flex justify-content-between">
                <label for="" class="h6">
                    Buku yang dipinjam
                </label>
            </div>
         
            <hr>
            <div class="alert alert-info ">
                <i class="icon-sm" data-feather="info"></i>
                <span class="ml-2">Denda keterlambatan buku Rp.<span>1.000</span> / Hari</span>
            </div>
            <div class="d-flex justify-content-end">
                <div class="">
                    <div class="row mb-3">
                        <label for="tgl_pinjam" class="col-sm-3 col-form-label">Tanggal Pinjam</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <input type="text" id="tgl_pinjam" class="form-control text-center"
                                    placeholder="DD-MM-YYYY" readonly>
                                <span class="input-group-text ">
                                    s/d
                                </span>
                                <input type="text" id="tgl_kembali" class="form-control text-center"
                                    placeholder="DD-MM-YYYY" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tgl_pengembalian" class="col-sm-3 col-form-label">Tanggal Pengembalian</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <input type="date" class="form-control text-center" placeholder="DD-MM-YYYY"
                                    id="tgl_pengembalian" value="{{ date('Y-m-d') }}">
                            
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="keterlambatan" class="col-sm-3 col-form-label">Keterlambatan</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="0" value="0" readonly
                                    id="keterlambatan">
                                <span class="input-group-text ">
                                    Hari
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="denda" class="col-sm-3 col-form-label">Denda</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <span class="input-group-text ">
                                    Rp
                                </span>
                                <input type="number" class="form-control" placeholder="Denda" value="0"
                                    id="denda">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="diskon" class="col-sm-3 col-form-label">Diskon</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <span class="input-group-text ">
                                    Rp
                                </span>
                                <input type="number" class="form-control" placeholder="" value="0"
                                    id="diskon">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="total_bayar" class="col-sm-3 col-form-label">Total Bayar</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <span class="input-group-text ">
                                    Rp
                                </span>
                                <input type="text" class="form-control" placeholder="" value="0"
                                    id="total" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="id_petugas" class="col-sm-3 col-form-label">Petugas</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <span class="input-group-text ">
                                    <i class="icon-sm" data-feather="user"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Petugas"
                                    value="{{ Auth::user()->name }}" readonly>
                                <span class="input-group-text" id="id_petugas">
                                    {{ Auth::user()->id }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a class="btn btn-sm btn-danger" type="button" href="{{ route('list_peminjaman') }}">
                    <i class="icon-sm" data-feather="chevron-left"></i>
                    Batal</a>
                <button class="btn btn-sm btn-success">
                    <i class="icon-sm" data-feather="save"></i>
                    Simpan Data</button>
            </div>
        </div>

        <script>
            $("#id_anggota").on("change", function() {
                get_peminjam($(this).val());
            });
            $("#btn-search").on("click", function() {
                get_peminjam($("#id_anggota").val());
            });

            function get_peminjam(kd_anggota) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('get_pengembalian') }}",
                    data: {
                        id_anggota: kd_anggota,
                        is_metode: "ambil"
                    },
                    beforeSend: function() {
                        $("#nm_peminjam").val("Loading...");
                        $("#kelas").val("Loading...");
                        $("#list_buku").html("")
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
                        console.log(data)
                        let item = data.data;
                        Swal.close()

                        if (data.success == false) {
                            Swal.fire({
                                icon: "error",
                                text: "Data Anggota Tidak di temukan!"
                            })
                            $("#nm_peminjam").val("");
                            $("#nm_kelas").val("");
                            $("#id_kelas").html("");
                            $("#list_buku").html("")
                            $("#tgl_kembali").val("");
                            $("#tgl_pinjam").val("");
                            $("#denda").val("");
                            $("#keterlambatan").val("");
                            $("#diskon").val("");
                            $("#total").val("");

                        } else {

                            let list_buku = "";

                            $.each(item.buku, function(index, value) {
                                list_buku += ` <div class="row ">`;
                                list_buku += ` <div class="col-sm">`;
                                list_buku += ` <div class="row mb-3">`;
                                list_buku += ` <div class="col-sm">`;
                                list_buku += ` <div class="input-group">`;
                                list_buku += ` <span class="input-group-text">${value.kd_buku}</span>`;
                                list_buku += ` <input type="text" class="form-control" id="judul" placeholder="Judul Buku" value="${value.judul}" readonly>`;
                                list_buku += ` <span class="input-group-text ">`;
                                list_buku += ` ${value.qty}`;
                                list_buku += ` </span>`;
                                list_buku += ` </div>`;
                                list_buku += ` </div>`;
                                list_buku += ` </div>`;
                                list_buku += ` </div>`;
                                list_buku += ` </div>`;

                            });
                            $("#lit_peminjaman_buku").html(list_buku)

                            $.each(item.peminjam, function(index, value) {
                                $("#nm_peminjam").val(value.nm_lengkap);
                                $("#nm_kelas").val(value.nm_kelas);
                                $("#id_kelas").html(value.id_kelas);
                                $("#tgl_pinjam").val(moment(value.tgl_pinjam, "YYYY-MM-DD").format(
                                    "DD-MM-YYYY"));
                                $("#tgl_kembali").val(moment(value.tgl_kembali, "YYYY-MM-DD").format(
                                    "DD-MM-YYYY"));
                                var tglKembali = value.tgl_kembali;
                                var tglKembaliObj = new Date(tglKembali);
                                $("#list_buku").html("")

                                var today = new Date($("#tgl_pengembalian").val());
                                if (tglKembaliObj !== today && tglKembaliObj < today) {
                                    var hariIni = today.getDay();
                                    var selisihHari = Math.floor((today - tglKembaliObj) / (1000 * 60 * 60 *
                                        24));
                                    var denda = selisihHari * 1000;
                                    $("#keterlambatan").val(selisihHari);
                                    if (hariIni !== 0 && hariIni !== 6) {
                                        $("#denda").val(denda);
                                    }
                                }
                            });

                            $("#tgl_pengembalian").on("change", function() {
                                var tglKembali = $("#tgl_kembali").val();
                                var tglKembaliObj = moment(tglKembali, "DD-MM-YYYY").format("DD-MM-YYYY");
                                var today = moment($(this).val(), "YYYY-MM-DD").format("DD-MM-YYYY");

                                console.log(tglKembaliObj, today)
                                if (tglKembaliObj !== today && tglKembaliObj < today) {
                                    var hariIni = moment(today, "DD-MM-YYYY").format("d");
                                    var selisihHari = Math.floor((today - tglKembaliObj) / (1000 * 60 * 60 *
                                        24));
                                    var denda = selisihHari * 1000;

                                    console.log(hariIni, selisihHari, denda)
                                    $("#keterlambatan").val(selisihHari);
                                    if (hariIni !== 0 && hariIni !== 6) {
                                        $("#denda").val(denda);
                                    }
                                } else {
                                    $("#keterlambatan").val(0);
                                    $("#denda").val(0);
                                }
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

            $(document).ready(function() {
                $('#denda').on('keyup', function() {
                    var denda = $('#denda').val();
                    var diskon = $('#diskon').val();
                    var total = denda - diskon;
                    $('#total').val(total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
                });
                $('#diskon').on('keyup', function() {
                    var denda = $('#denda').val();
                    var diskon = $('#diskon').val();
                    var total = denda - diskon;
                    $('#total').val(total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
                });

            });

            function simpan_pengembalian() {

                let id_anggota = $("#id_anggota").val()
                let denda = $("#denda").val()
                let tgl_pengembalian = $("#tgl_pengembalian").val()

                $.ajax({
                    type: "POST",
                    data: {
                        id_anggota: id_anggota,
                        id_petugas: id_petugas,
                        tgl_pengembalian: tgl_pengembalian,
                        denda: denda,
                    },
                    beforeSend: function() {
                        console.log("Loading...")
                    },
                    success: function(data) {
                        if (data.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil Tersimpan",
                                text: "Data berhasil tersimpan!"
                            })
                            window.assign("{{ route('list_peminjaman') }}")
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal Tersimpan",
                                text: "Terjadi kesalahan dalam proses menyimpan"
                            })
                        }
                    }
                }).fail(function(err) {
                    Swal.fire({
                        icon: "error",
                        title: "Terjadi Kesalahan",
                        text: "Terjadi kesalahan, Harap check kembali dalam proses meyimpan"
                    })
                })

            }
        </script>

        <script></script>


</x-app-layout>
