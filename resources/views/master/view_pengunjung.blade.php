<x-blank-layout>
    <div class="page-content d-flex align-items-center justify-content-center" style="background-image: url({{ asset('assets/images/bg-library.jpg') }}); background-size: cover; background-position: center;">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-12 ps-md-0">
                                <div class="auth-form-wrapper px-4 py-4">
                                    <form class="forms-sample">
                                        <div class="d-flex justify-content-center mb-2">
                                            <img src="{{ asset('assets/images/logo-ponpes.png') }}"
                                                alt="Logo Pondok Pesantren" width="200px">
                                        </div>
                                        <div class="d-flex justify-content-center mb-3">
                                            <h6>
                                                Selamat Datang Di Perpustakaan Pondok Pesantren Miftahul Ulum
                                            </h6>
                                        </div>
                                        <div class="alert alert-warning">
                                            <i class="icon-sm mr-2" data-feather="info"></i>
                                            Silahkan isi Data Pengunjung terlebih dahulu 
                                        </div>
                                        <div class="mb-3">
                                            <label for="tgl_kunjungan" class="form-label">Tanggal Kunjungan</label>
                                            <input type="search" name="tgl_kunjungan" class="form-control"
                                                value="{{ date('d-m-Y h:i:s') }}" id="tgl_kunjungan"
                                                placeholder="Tanggal Kunjungan" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nm_lengkap" class="form-label">Nama Lengkap</label>
                                            <input type="search" name="nm_lengkap" class="form-control" id="nm_lengkap"
                                                placeholder="Nama Lengkap" maxlength="200">
                                        </div>
                                        <div class="mb-3">
                                            <label for="kelas" class="form-label">Kelas</label>
                                            <input type="search" name="kelas" class="form-control" id="kelas"
                                                placeholder="Kelas" maxlength="200">
                                        </div>
                                        <div class="mb-3">
                                            <label for="tujuan" class="form-label">Tujuan Ke Perpustakaan</label>
                                            <input type="search" name="tujuan" class="form-control" id="tujuan"
                                                placeholder="Tujuan Ke Perpustakaan" maxlength="200">
                                        </div>
                                        <div>
                                            <button class="btn btn-success w-100" id="btn-simpan">
                                                <i class="icon-sm" data-feather="save"></i>
                                                Simpan Data</button>
                                            <button class="btn btn-success w-100" id="btn-simpan">
                                                <i class="icon-sm" data-feather="save"></i>
                                                Simpan Data</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready({
            $("#nm_lengkap").focus();
        })
    </script>


</x-blank-layout>
