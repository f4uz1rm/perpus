<x-app-layout>
    <div class="card mb-2">
        <div class="card-header card-title">Pengembalian Buku</div>
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
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Tanggal Pinjam</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="DD-MM-YYYY" readonly>
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
                                <textarea type="text" class="form-control" placeholder="Keterangan Lain" readonly> </textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <hr>

            <div class="alert alert-warning">
                <i class="icon-sm" data-feather="info"></i>
                <span class="ml-2">Checklist buku yang akan dikembalikan</span>
            </div>
            <div class=" mb-4 d-flex justify-content-between">
                <label for="" class="h6">
                    Buku yang dipinjam
                </label>
                
            </div>

            <div class="">
                @for ($i = 0; $i < 5; $i++)
                    <div class="row ">
                        <div class="col-sm">
                            <div class="row mb-3">
                                <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Judul Buku</label>
                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">Kode Buku</span>
                                        <input type="text" class="form-control" id="exampleInputUsername2"
                                            placeholder="Judul Buku" readonly>
                                        <span class="input-group-text ">
                                           Qty
                                        </span>
                                        
                                        <input type="text" class="form-control" placeholder="Keterangan">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endfor
            </div>

            <hr>
            <div class="alert alert-info ">
                <i class="icon-sm" data-feather="info"></i>
                <span class="ml-2">Denda keterlambatan buku Rp.<span>1.000</span> / Hari</span>
            </div>
            <div class="d-flex justify-content-end">
                <div class="">
                    <div class="row mb-3">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Tanggal Pinjam</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <input type="text" class="form-control text-center" placeholder="DD-MM-YYYY" readonly>
                                <span class="input-group-text ">
                                    s/d
                                </span>
                                <input type="text" class="form-control text-center" placeholder="DD-MM-YYYY" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Keterlambatan</label>
                        <div class="col-sm">
                            <div class="input-group">

                                <input type="text" class="form-control" placeholder="0" value="0" readonly>
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
                                <input type="number" class="form-control" placeholder="Denda" value="0" id="denda">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Diskon</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <span class="input-group-text ">
                                    Rp
                                </span>
                                <input type="number" class="form-control" placeholder="" value="0" id="diskon">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Total Bayar</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <span class="input-group-text ">
                                    Rp
                                </span>
                                <input type="text" class="form-control" placeholder="" value="0" id="total" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Petugas</label>
                        <div class="col-sm">
                            <div class="input-group">
                                <span class="input-group-text ">
                                    <i class="icon-sm" data-feather="user"></i>
                                </span>
                                <input type="text" class="form-control" placeholder=""
                                    value="{{ Auth::user()->name }}" readonly>
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
        </script>


</x-app-layout>
