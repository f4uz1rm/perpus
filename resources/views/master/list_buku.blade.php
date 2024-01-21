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
                                ISBN
                            </th>
                            <th>
                                Pengarang
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
                    <tbody>
                        <tr>
                            <td class="text-center">AB001</td>
                            <td class="text-wrap">Kitab Kuning</td>
                            <td class="text-center">2024</td>
                            <td class="text-center">5</td>
                            <td class="text-center">-</td>
                            <td class="text-wrap">Fauzi</td>
                            <td class="text-wrap">Mauladani</td>
                            <td class="text-center">A001</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-danger" id="btn-delete">Hapus</button>
                                <button class="btn btn-sm btn-success" id="btn-edit">Ubah</button>
                            </td>
                        </tr>
                    </tbody>
                </x-table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-buku" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="varyingModalLabel">Tambah / Ubah Buku</h5>
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
                            <label for="isbn" class="form-label">ISBN</label>
                            <input type="search" class="form-control" id="isbn" placeholder="ISBN">
                        </div>
                        <div class="mb-3">
                            <label for="pengarang" class="form-label">Pengarang</label>
                            <input type="search" class="form-control" id="pengarang" placeholder="Pengarang">
                        </div>
                        <div class="mb-3">
                            <label for="penerbit" class="form-label">Penerbit</label>
                            <input type="search" class="form-control" id="penerbit" placeholder="Penerbit">
                        </div>
                        <div class="mb-3">
                            <label for="jml_buku" class="form-label">Jumlah Buku</label>
                            <input type="search" class="form-control" id="jml_buku" placeholder="Jumlah Buku">
                        </div>
                        <div class="mb-3">
                            <label for="lokasi_rak" class="form-label">Lokasi RAK</label>
                            <input type="search" class="form-control" id="lokasi_rak" placeholder="Contoh ( A01 )">
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
        $(document).ready(function() {
            $('table').DataTable();
        })

        $("#btn-add").on("click", function() {
            $("#modal-buku").modal("show");
        })
    </script>

</x-app-layout>