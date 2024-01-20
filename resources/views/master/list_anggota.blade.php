<x-app-layout>
    <div class="card">

        <div class="card-header card-title d-flex justify-content-between">
            <div class="">
                Data Anggota
            </div>
            <x-btn-add />
        </div>
        <div class="card-body py-0">
            <div class="table-responsive">
                <x-table id="table-buku">
                    <thead>
                        <tr class="text-center">
                            <th>
                                Print
                            </th>
                            <th>
                                Kode Anggota
                            </th>
                            <th>
                                Nama Lengkap
                            </th>
                            <th>
                                Jenis Kelamin
                            </th>
                            <th>
                                Kelas
                            </th>
                            <th>
                                Masa Aktif Anggota
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                #
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">
                                <i class="icon-sm" data-feather="printer"></i>

                            </td>
                            <td class="text-center">KT001</td>
                            <td class="text-wrap">Fauzi Rizky Mauladani</td>
                            <td class="text-center">Laki - Laki</td>
                            <td class="text-center">7A</td>
                            <td class="text-center">12 Januari 2024</td>
                            <td class="text-center">Aktif</td>
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

    <div class="modal fade" id="modal-kategori" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="varyingModalLabel">Tambah / Ubah Anggota</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="kd_kategori" class="form-label">Kode Kategori</label>
                            <input type="search" class="form-control" id="kd_kategori" readonly
                                placeholder="Otomatis Terisi">
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="ketegori" class="form-label">Kategori</label>
                                    <input type="text" id="" class="form-control" placeholder="Kategori">
                                </div>
                            </div>
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

    <script>
        $(document).ready(function() {
            $('table').DataTable();
        })
    </script>

</x-app-layout>
