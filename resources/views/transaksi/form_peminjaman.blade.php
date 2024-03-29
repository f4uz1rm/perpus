<x-app-layout>
    <div class="card mb-2">
        <div class="card-header card-title">Tambah Peminjaman Buku</div>
        <div class="card-body py-1">
            <div class="h6 mb-2">Detail Peminjam</div>

            <div class="row ">
                <div class="col-sm-10">

                    <div class="row mb-3">
                        <label for="search_kd_anggota" class="col-sm-3 col-form-label">Nama Peminjam</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <input type="search" class="form-control" id="search_kd_anggota"
                                    placeholder="Masukna Kode Anggota">

                                <span class="input-group-text" id="btn-camera">
                                    <i class="icon-sm" data-feather="camera"></i>
                                </span>
                            </div>

                            <div class="text-danger">
                                *Jika nama anggota tidak di temukan harap isi telebih dahulu di halaman <a
                                    href="{{ route('list_anggota') }}">Data Anggota</a>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kd_anggota" class="col-sm-3 col-form-label">Kode Anggota</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <input type="text" class="form-control" id="kd_anggota" placeholder="Kode Anggota"
                                    tabindex="1" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kd_anggota" class="col-sm-3 col-form-label">Nama Peminjam</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <input type="text" class="form-control" id="nm_peminjam" placeholder="Nama Anggota"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kd_anggota" class="col-sm-3 col-form-label">Kelas</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <input type="text" class="form-control" id="nm_kelas" placeholder="Kelas" readonly>
                                <span class="input-group-text" id="id_kelas">

                                </span>
                            </div>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tgl_pinjam" class="col-sm-3 col-form-label">Tanggal Pinjam</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <input type="date" id="tgl_pinjam" class="form-control" placeholder="DD-MM-YYYY">
                                {{-- <span class="input-group-text">
                                    <i class="icon-sm" data-feather="calendar"></i>
                                </span> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tgl_kembali" class="col-sm-3 col-form-label">Tanggal Kembali</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <input type="date" id="tgl_kembali" class="form-control" placeholder="DD-MM-YYYY">
                                {{-- <span class="input-group-text">
                                    <i class="icon-sm" data-feather="calendar"></i>
                                </span> --}}
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row mb-3">
                        <label for="keterangan" class="col-sm-3 col-form-label">Keterangan Lain</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <input type="text" id="keterangan" class="form-control" tabindex="2"
                                    placeholder="Keterangan Lain">
                            </div>
                        </div>
                    </div> --}}
                </div>

            </div>
            <hr>
            <div class="mb-3">
                <label for="kd_buku" class="form-label">Kode Buku</label>
                <div class="input-group">
                    <input type="search" class="form-control" id="kd_buku" placeholder="Masukan Kode Buku"
                        tabindex="3">
                    <span class="input-group-text" id="btn-camera">
                        <i class="icon-sm" data-feather="camera"></i>
                    </span>

                </div>
            </div>
            <div class=" mb-2 d-flex justify-content-between">
                <label for="" class="h6">
                    Detail Buku
                </label>


            </div>
            <div class="" id="list_buku">

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
<!-- Modal Camera -->
<div class="modal fade" id="modalCamera" tabindex="-1" aria-labelledby="modalCameraLabel" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCameraLabel">Scan Barcode</h5>
                <button type="button" data-feather="x" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <div style="width: 500px" id="reader"></div>

            </div>
            <footer>
                <div class="modal-footer">

                </div>
            </footer>
        </div>
    </div>
</div>
</div>

<!-- CDN Jsbarcode -->
{{-- <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script> --}}
<script src="{{ asset('assets/js/html5-qrcode.min.js') }}" type="text/javascript"></script>
<!-- End Modal Camera -->
<script>
    var html5QrcodeScanner = new Html5Qrcode("reader");
    var cameraId = "";
    var isFrontCamera = false;

    function getCameras() {
        Html5Qrcode.getCameras().then(devices => {
            isFrontCamera = false;
            Html5Qrcode.getCameras().then(devices => {
                if (devices && devices.length) {
                    cameraId = devices[devices.length - 1].id;
                    updateScanner(cameraId);
                }
            }).catch(err => {
                console.log(err);
            });
        }).catch(err => {
            console.log(err);
        });
    }

    function updateScanner(newCameraId) {
        if (html5QrcodeScanner.isScanning) {
            html5QrcodeScanner.stop().then(ignore => {
                startScanner(newCameraId);
            }).catch(err => {
                console.log(err);
            });
        } else {
            startScanner(newCameraId);
        }
    }

    function startScanner(cameraId) {

        const backCamera = {
            facingMode: {
                exact: "environment"
            }
        };

        html5QrcodeScanner.start(
                cameraId, {
                    facingMode: {
                        exact: "environment"
                    },
                    fps: 10,
                    qrbox: {
                        width: 400,
                        height: 150
                    },
                    aspectRatio: 1.0,
                    disableFlip: true,
                },
                qrCodeMessage  => {

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Kode QR berhasil di scan',
                        timer: 2000,
                    }).then((result) => {})
                    getCameras();
                    html5QrcodeScanner.stop().then(ignore => {

                        // Scanner berhenti
                    }).catch(err => {
                        console.error(err);
                    });
                },
                errorMessage => {
                    // console.error(errorMessage);
                })
            .catch(err => {
                console.log(err);
            });
    }

    function onScanSuccess(decodedText, decodedResult) {
  // Handle the scanned code as you like, for example:
  console.log(`Code matched = ${decodedText}`, decodedResult);
}
</script>


<script>
    $("#btn-camera").on("click", function() {
        getCameras();
        $("#modalCamera").modal("show");
    })
</script>







<script>
    $("#kd_buku").on("change", function() {
        get_buku_bykode(this.value)
    })
    $("#search_kd_anggota").on("change", function() {
        get_anggota_bykode(this.value)
    })

    $(document).ready(function() {
        $("#search_kd_anggota").focus();
    })

    function get_anggota_bykode(kd_anggota) {
        $.ajax({
            type: "GET",
            url: "{{ route('get_anggota') }}",
            data: {
                id_anggota: kd_anggota
            },
            beforeSend: function() {
                $("#nm_peminjam").val("Loading...");
                $("#kelas").val("Loading...");
                $("#jns_kelamin").val("Loading...");
                $("#nisn").val("Loading...");
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
                let item = data.data;
                Swal.close();
                if (item == null) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "Anggota Tidak Ditemukan",
                        showConfirmButton: false,
                        timer: 1000
                    })
                    $("#search_kd_anggota").focus();
                    $("#search_kd_anggota").val("");

                    $("#search_kd_anggota").val("");
                    $("#kd_anggota").val("");
                    $("#nm_peminjam").val("");
                    $("#nm_kelas").val("");
                    $("#id_kelas").html("");
                    $("#jns_kelamin").val("");
                    $("#nisn").val("");
                    $("#tgl_pinjam").val("");
                    $("#tgl_kembali").val("");
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: item.nm_lengkap,
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        $("#keterangan").focus();
                    })
                    $("#search_kd_anggota").val("");
                    $("#kd_anggota").val(kd_anggota);
                    $("#nm_peminjam").val(item.nm_lengkap);
                    $("#nm_kelas").val(item.nm_kelas);
                    $("#id_kelas").html(item.id_kelas);
                    $("#jns_kelamin").val(item.jns_kelamin);
                    $("#nisn").val(item.nisn);
                    $("#tgl_pinjam").val("{{ date('Y-m-d') }}");
                    $("#tgl_kembali").val("{{ date('Y-m-d', strtotime('+3 days')) }}");
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
                        <div class="col-sm">
                            <div class="row mb-3">
                            <div class="col-sm">
                                <div class="input-group">
                                <span class="input-group-text" id="kd_buku">${item.kd_buku}</span>
                                <input type="text" class="form-control" id="judul_buku" value="${item.judul}" placeholder="Judul Buku" readonly>
                               <input type="number" class="form-control quantity" value="1">
                               <span class="input-group-text delete-book" data-kd-buku="${item.kd_buku}">
                                <i class="icon-sm mr-2 text-danger" data-feather="trash"></i> Hapus
                            </span>
                                
                                </div>
                            </div>
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

        list_buku.find(".list_buku_pinjam").each(function() {
            let kdBuku = $(this).data("kd-buku");
            let jumlahBuku = $(this).find(".quantity").val();

            bukuArray.push({
                kd_buku: kdBuku,
                qty: jumlahBuku,
            });
        });

        if (bukuArray.length == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Daftar Buku Tidak Boleh Kosong",
            })
            return;
        } else if (kd_anggota == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Kode Anggota Tidak Boleh Kosong",
            })
            return;
        } else {
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
                        url: "{{ route('simpan_peminjaman') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_kelas: $("#id_kelas").text(),
                            id_anggota: kd_anggota,
                            tgl_pinjam: tgl_pinjam,
                            tgl_kembali: tgl_kembali,
                            keterangan: keterangan,
                            id_petugas: "{{ Auth::user()->id }}",
                            id_buku: bukuArray
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
                            console.log(data);
                            Swal.close();
                            if (data.success == true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then((result) => {
                                    window.location.href =
                                        "{{ route('list_peminjaman') }}";
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


    }
</script>
