<x-blank-layout>
    <div class="page-content d-flex align-items-center justify-content-center"
        style="background-image: url({{ asset('assets/images/bg-library.jpg') }}); background-size: cover; background-position: center;">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-12 ps-md-0">
                                <div class="auth-form-wrapper px-4 py-4">
                                    <div class="d-flex justify-content-center mb-2">
                                        <img src="{{ asset('assets/images/logo-ponpes.png') }}" alt="Logo Miftahul Ulum"
                                            width="100px">
                                    </div>
                                    <div class="d-flex justify-content-center mb-3">
                                        <h6 class="text-center">
                                            Selamat Datang Di Perpustakaan Miftahul'ulum
                                        </h6>
                                    </div>
                                    <div class="alert alert-warning">
                                        <i class="icon-sm mr-2" data-feather="info"></i>
                                        Silahkan isi Data Pengunjung terlebih dahulu
                                    </div>
                                    <div class="mb-3">
                                        <label for="tgl_kunjungan" class="form-label">Tanggal Kunjungan</label>
                                        <input type="search" name="tgl_kunjungan" class="form-control" value=""
                                            id="tgl_kunjungan" placeholder="Tanggal Kunjungan" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nm_lengkap" class="form-label">Nama Lengkap</label>
                                        <input type="search" name="nm_lengkap" class="form-control" id="nm_lengkap"
                                            placeholder="Nama Lengkap" maxlength="200">
                                    </div>
                                    <div class="mb-3">
                                        <label for="kelas" class="form-label">Kelas</label>
                                        <select name="kelas" id="kelas" class="form-control">
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tujuan" class="form-label">Tujuan Ke Perpustakaan</label>
                                        <input type="search" name="tujuan" class="form-control" id="tujuan"
                                            placeholder="Tujuan Ke Perpustakaan" maxlength="200">
                                    </div>
                                    <div>
                                        <button class="btn btn-success py-3 w-100" id="btn-simpan">
                                            <i class="icon-sm" data-feather="save"></i>
                                            Simpan Data</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        setInterval(() => {
            $("#tgl_kunjungan").val(moment().format('DD-MM-YYYY  h:mm:ss'));
        }, 1000);

        get_kelas()

        function get_kelas() {
            $.ajax({
                url: "{{ route('get_kelas') }}",
                type: "GET",
                typeData: "JSON",
                success: function(data) {
                    if (data.success == true) {
                        var html = "";
                        html += "<option value='' selected>Silahkan Pilih Kelas</option>";
                        $.each(data.data, function(index, item) {
                            html += "<option value='" + item.id + "'>" + item.nm_kelas + "</option>";
                        })
                        $("#kelas").html(html);
                    }
                }
            }).fail(function(err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: "Silahkan Coba Lagi",
                })
            })


        }

        $("#btn-simpan").click(function() {
            tambah_kunjungan();
        })

        $("#tujuan").on("keypress", function() {
            if (event.keyCode === 13) {
                tambah_kunjungan();
            }
        })

        function tambah_kunjungan() {

            var nm_lengkap = $("#nm_lengkap").val();
            var kelas = $("#kelas").val();
            var tujuan = $("#tujuan").val();
            var tgl_kunjungan = $("#tgl_kunjungan").val();

            $("#nm_lengkap, #kelas , #tujuan").removeClass("is-invalid");

            if (nm_lengkap == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Nama Lengkap Harus Diisi',
                })
                $("#nm_lengkap").addClass("is-invalid");
            } else if (kelas == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Kelas Harus Diisi',
                })
                $("#kelas").addClass("is-invalid");
            } else if (tujuan == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Tujuan Harus Diisi',
                })
                $("#tujuan").addClass("is-invalid");
            } else {
                $.ajax({
                    url: "{{ route('tambah_pengunjung') }}",
                    type: "POST",
                    typeData: "JSON",
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Mohon Tunggu',
                            html: 'Sedang Menyimpan Data',
                            didOpen: () => {
                                Swal.showLoading()
                            },
                        })
                    },
                    data: {
                        _token: "{{ csrf_token() }}",
                        nm_lengkap: nm_lengkap,
                        id_kelas: kelas,
                        tujuan: tujuan,
                        tgl_kunjungan: moment(tgl_kunjungan, 'DD-MM-YYYY h:i:s').format('YYYY-MM-DD HH:mm:ss'),
                    },
                    success: function(data) {
                        if (data.success == true) {
                            Swal.fire({
                                icon: 'success',
                                title: "Data Berhasil Disimpan",
                                text: 'Selamat Datang Di Perpustakaan',
                                timer: 1500,
                                showConfirmButton: false,
                            })
                            $("#nm_lengkap, #kelas , #tujuan").val("").trigger("change");
                            $("#tgl_kunjungan").val(moment().format('DD-MM-YYYY  h:mm:ss'));
                        }
                    }
                }).fail(function(err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: "Silahkan Coba Lagi",
                    })
                })
            }

        }
    </script>


</x-blank-layout>
