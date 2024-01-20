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
                            <select name="" id="" class="form-control">
                                <option value="">Pilih Anggota</option>
                            </select>
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
                <label for="kd_kategori" class="form-label">Kode Buku</label>
                <div class="input-group">
                    <input type="search" class="form-control" id="kd_kategori" placeholder="Masukan Kode Buku">
                    <span class="input-group-text">
                        <i class="icon-sm" data-feather="search"></i>
                    </span>
                </div>
            </div>
            <div class=" mb-2 d-flex justify-content-between">
                <label for="" class="h6">
                    Detail Buku
                </label>
                <button class="btn btn-danger btn-sm">
                    <i class="icon-sm" data-feather="trash"></i>
                    Hapus Semua</button>

            </div>
            <div class="">
                @for ($i = 0; $i < 5; $i++)
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
                @endfor
            </div>


        </div>

        <div class="card-footer d-flex justify-content-between">
            <a class="btn btn-sm btn-danger" type="button" href="{{ route('list_peminjaman') }}">Batal</a>
            <button class="btn btn-sm btn-success">
                <i class="icon-sm" data-feather="save"></i>
                Simpan Data</button>
        </div>
    </div>
</x-app-layout>
