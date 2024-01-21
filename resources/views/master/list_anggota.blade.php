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
                                Aksi
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

    <div class="modal fade" id="modal-anggota" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="varyingModalLabel">Tambah / Ubah Anggota</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="kd_anggota" class="form-label">Kode Anggota</label>
                            <input type="search" class="form-control" id="kd_anggota" readonly
                                placeholder="Otomatis Terisi">
                        </div>
                        <div class="mb-3">
                            <label for="nm_anggota" class="form-label">NISN ( Nomer Induk Siswa Nasional )</label>
                            <input type="search" class="form-control" id="nisn"
                                placeholder="Masukan NISN Jika tersedia">
                        </div>
                        <div class="mb-3">
                            <label for="nm_anggota" class="form-label">Nama Anggota</label>
                            <input type="search" class="form-control" id="nm_anggota" placeholder="Nama Anggota">
                        </div>

                        <div class="mb-3">
                            <label for="nm_anggota" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" id="">
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nm_anggota" class="form-label">Status</label>
                            <select class="form-control" id="">
                                <option value="siswa">Siswa / Siswi</option>
                                <option value="guru">Guru</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nm_anggota" class="form-label">Kelas</label>
                            <select class="form-control" id="">
                                <option value="" selected>Pilih Kelas</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nm_anggota" class="form-label">Masa Aktif</label>
                            <div class="input-group">
                                <select class="form-control" id="">
                                    <option value="" selected>Pilih Durasi</option>
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">4</option>
                                </select>
                                <span class="input-group-text">Tahun</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nm_anggota" class="form-label">Masa Aktif Sampai</label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="" id="" placeholder="DD-MM-YYYY">
                                <span class="input-group-text">
                                    <i class="icon-sm" data-feather="calendar"></i>
                                </span>
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
            $('table').DataTable({
                responsive: true,
            });
        })
        $("#btn-add").click(function() {
            $("#modal-anggota").modal("show");
        })
    </script>

</x-app-layout>
