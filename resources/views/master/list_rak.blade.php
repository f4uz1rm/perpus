<x-app-layout>

    <div class="card">

        <div class="card-header card-title d-flex justify-content-between">
            <div class="">
                Data Rak
            </div>
            <x-btn-add />
        </div>
        <div class="card-body py-0">
            <div class="table-responsive">
                <x-table id="table-rak">
                    <thead>
                        <tr class="text-center">
                            <th>
                                Kode Rak
                            </th>
                            <th>
                                Nama Rak
                            </th>
                            <th>
                                Lokasi Rak
                            </th>
                            <th>
                                #
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">KD001</td>
                            <td class="text-center">Ilmu Pengetahuan Sosial</td>
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
    <div class="modal fade" id="modal-kelas" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="varyingModalLabel">Tambah / Ubah Rak</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="kd_kategori" class="form-label">Kode Kelas</label>
                            <input type="search" class="form-control" id="kd_kategori" readonly
                                placeholder="Otomatis Terisi">
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="ketegori" class="form-label">Nama Rak</label>
                                    <input type="text" id="" class="form-control" placeholder="Nama Rak">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="ketegori" class="form-label">Lokasi Rak</label>
                                    <input type="text" id="" class="form-control" placeholder="Lokasi Rak">
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


        $("#btn-add").on("click", function() {
            $("#modal-kelas").modal("show");
        })
    </script>
</x-app-layout>
